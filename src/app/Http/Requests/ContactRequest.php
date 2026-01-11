<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // 修正ボタンで戻るときはバリデーションしない
        if ($this->has('back')) {
            return [];
        }

        return [
            'last_name'   => ['required', 'string'],
            'first_name'  => ['required', 'string'],
            'gender'      => ['required'],
            'email'       => ['required', 'email', 'max:255'],

            'tel1'        => ['nullable', 'string'],
            'tel2'        => ['nullable', 'string'],
            'tel3'        => ['nullable', 'string'],

            'address'     => ['required', 'string', 'max:255'],
            'building'    => ['nullable', 'string', 'max:255'],
            'category_id' => ['required'],
            'detail'      => ['required', 'string', 'max:120'],
        ];
    }

    public function withValidator($validator)
    {
        // バリデーションを行わずに戻る
        if ($this->has('back')) {
            return;
        }

        /**
         * telは3分割だけど、エラー表示は1つだけ
         * 必須/形式/桁数は after でまとめて判定する
         *エラー表記示は tel1 の下部に表示する
         */


        $validator->after(function ($validator) {
            $tel1 = trim((string) $this->input('tel1', ''));
            $tel2 = trim((string) $this->input('tel2', ''));
            $tel3 = trim((string) $this->input('tel3', ''));

            // 未入力かどうかのチェック：エラー表示は1つだけ
            if ($tel1 === '' || $tel2 === '' || $tel3 === '') {
                $validator->errors()->add('tel1', '電話番号を入力してください');
                return;
            }

            // 半角数字のみかどうかのチェック
            if (!ctype_digit($tel1) || !ctype_digit($tel2) || !ctype_digit($tel3)) {
                $validator->errors()->add('tel1', '電話番号は半角英数字で入力してください');
                return;
            }

            // 5桁超過に対するチェック
            if (strlen($tel1) > 5 || strlen($tel2) > 5 || strlen($tel3) > 5) {
                $validator->errors()->add('tel1', '電話番号は5桁まで数字で入力してください');
                return;
            }

            // 姓名合計8文字以内かのチェック
            $last  = $this->input('last_name', '');
            $first = $this->input('first_name', '');

            if (mb_strlen($last . $first) > 8) {
                $validator->errors()->add();
            }
        });
    }


    public function messages()
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'      => 'お問い合わせ内容を入力してください',
            'detail.max'           => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
