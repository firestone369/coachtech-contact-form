<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminContactController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        // ページネーションの表示数をここで変更可能
        $contacts = Contact::query()
            ->with('category')
            ->search($request)
            ->orderByDesc('id')
            ->paginate(7)
            ->appends($request->query());

        return view('admin.dashboard', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        return redirect('/admin?' . http_build_query($request->query()));
    }

    public function reset()
    {
        return redirect('/admin');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer'],
        ]);

        Contact::findOrFail($request->id)->delete();

        // 削除後も検索情報を保持
        $query = $request->except(['id', '_token']);
        return redirect('/admin?' . http_build_query($query));
    }

    public function export(Request $request): StreamedResponse
    {
        $contacts = Contact::query()
            ->with('category')
            ->search($request)
            ->orderByDesc('id')
            ->get();

        $fileName = 'contacts_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        return response()->streamDownload(function () use ($contacts) {
            $out = fopen('php://output', 'w');

            // Excel対策：UTF-8 BOM
            fwrite($out, "\xEF\xBB\xBF");

            fputcsv($out, [
                'ID',
                '氏名',
                '性別',
                'メールアドレス',
                '電話番号',
                '住所',
                '建物名',
                'お問い合わせの種類',
                'お問い合わせ内容',
                '作成日',
            ]);

            foreach ($contacts as $c) {
                $genderText = $c->gender == 1 ? '男性' : ($c->gender == 2 ? '女性' : 'その他');
                $telNoHyphen = preg_replace('/[^0-9]/', '', (string) $c->tel);

                fputcsv($out, [
                    $c->id,
                    trim(($c->last_name ?? '') . ' ' . ($c->first_name ?? '')),
                    $genderText,
                    $c->email,
                    $telNoHyphen,
                    $c->address,
                    $c->building,
                    optional($c->category)->content,
                    $c->detail,
                    optional($c->created_at)->format('Y-m-d'),
                ]);
            }

            fclose($out);
        }, $fileName, $headers);
    }
}
