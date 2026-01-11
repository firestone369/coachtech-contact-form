<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function form()
    {
        $categories = Category::all();
        return view('contact.form', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {

        $contact = $request->only(
            [
                'category_id',
                'first_name',
                'last_name',
                'gender',
                'email',
                'tel1',
                'tel2',
                'tel3',
                'address',
                'building',
                'detail',
        ]);

        $categories = Category::all();

        return view('contact.confirm', compact('contact', 'categories'));
    }


    public function store(ContactRequest $request)
    {
        if ($request->has('back')) {
            return redirect('/')->withInput();
        }

        $tel = $request->input('tel');
        // 電話番号を3分割で入力するための処理
        if (empty($tel)) {
            $tel = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');
        }

        Contact::create([
            'category_id' => $request->input('category_id'),
            'first_name'  => $request->input('first_name'),
            'last_name'   => $request->input('last_name'),
            'gender'      => $request->input('gender'),
            'email'       => $request->input('email'),
            'tel'         => $tel,
            'address'     => $request->input('address'),
            'building'    => $request->input('building'),
            'detail'      => $request->input('detail'),
        ]);

        return view('contact.thanks');
    }

    public function thanks()
    {
        return view('contact.thanks');
    }
}
