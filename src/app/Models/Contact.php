<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    /**
     * 一括代入を許可するカラム
     */
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function scopeSearch($query, Request $request)
    {
        if ($request->filled('keyword')) {
            $kw = trim((string) $request->input('keyword'));

            $kwNormalized = preg_replace('/\s+/u', ' ', $kw);

            $kwNoSpace = preg_replace('/\s+/u', '', $kw);

            $exact = $request->boolean('exact'); 

            $query->where(function ($q) use ($kw, $kwNormalized, $kwNoSpace, $exact) {
                if ($exact) {
                    // 完全一致（単体）
                    $q->where('last_name', $kw)
                        ->orWhere('first_name', $kw)
                        ->orWhere('email', $kw);

                    // 姓名の完全一致
                    $q->orWhereRaw("CONCAT(last_name, ' ', first_name) = ?", [$kwNormalized])
                        ->orWhereRaw("CONCAT(last_name, first_name) = ?", [$kwNoSpace]);
                } else {
                    // 部分一致
                    $q->where('last_name', 'like', "%{$kw}%")
                        ->orWhere('first_name', 'like', "%{$kw}%")
                        ->orWhere('email', 'like', "%{$kw}%");

                    $q->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$kwNormalized}%"])
                        ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$kwNoSpace}%"]);
                }
            });
        }

        // gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        // category_id
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // date（created_at の日付一致）
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        return $query;
    }

    /**
     * categories テーブルとのリレーション
     * 1つのお問い合わせ（contacts）は1つのカテゴリ（categories）に属する
     */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
