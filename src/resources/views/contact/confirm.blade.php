@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<main class="confirm">
    <h2 class="confirm-title">Confirm</h2>

    <form action="/contact" method="post" class="confirm-form">
        @csrf

        {{-- storeに渡す用（hidden属性一覧） --}}
        <input type="hidden" name="category_id" value="{{ $contact['category_id'] ?? '' }}">
        <input type="hidden" name="first_name" value="{{ $contact['first_name'] ?? '' }}">
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] ?? '' }}">
        <input type="hidden" name="gender" value="{{ $contact['gender'] ?? '' }}">
        <input type="hidden" name="email" value="{{ $contact['email'] ?? '' }}">
        <input type="hidden" name="tel1" value="{{ $contact['tel1'] ?? '' }}">
        <input type="hidden" name="tel2" value="{{ $contact['tel2'] ?? '' }}">
        <input type="hidden" name="tel3" value="{{ $contact['tel3'] ?? '' }}">
        <input type="hidden" name="address" value="{{ $contact['address'] ?? '' }}">
        <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}">
        <textarea name="detail" hidden>{{ $contact['detail'] ?? '' }}</textarea>

        {{-- 電話番号の表示は3分割で入力 / 管理画面での表示はハイフン無し --}}
        <input
            type="hidden"
            name="tel"
            value="{{ ($contact['tel1'] ?? '') . '-' . ($contact['tel2'] ?? '') . '-' . ($contact['tel3'] ?? '') }}">

        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>{{ $contact['last_name'] ?? '' }} {{ $contact['first_name'] ?? '' }}</td>
            </tr>

            <tr>
                <th>性別</th>
                <td>
                    {{ ($contact['gender'] ?? '') == 1 ? '男性' : '' }}
                    {{ ($contact['gender'] ?? '') == 2 ? '女性' : '' }}
                    {{ ($contact['gender'] ?? '') == 3 ? 'その他' : '' }}
                </td>
            </tr>

            <tr>
                <th>メールアドレス</th>
                <td>{{ $contact['email'] ?? '' }}</td>
            </tr>

            <tr>
                <th>電話番号</th>
                <td>{{ ($contact['tel1'] ?? '') . '-' . ($contact['tel2'] ?? '') . '-' . ($contact['tel3'] ?? '') }}</td>
            </tr>

            <tr>
                <th>住所</th>
                <td>{{ $contact['address'] ?? '' }}</td>
            </tr>

            <tr>
                <th>建物名</th>
                <td>{{ $contact['building'] ?? '' }}</td>
            </tr>

            <tr>
                <th>お問い合わせの種類</th>
                <td>
                    @foreach ($categories as $category)
                    @if ($category->id == ($contact['category_id'] ?? ''))
                    {{ $category->content }}
                    @endif
                    @endforeach
                </td>
            </tr>

            <tr class="message-row">
                <th>お問い合わせ内容</th>
                <td>{{ nl2br(e($contact['detail'] ?? '')) }}</td>
            </tr>
        </table>

        <div class="confirm-buttons">
            <button type="submit" class="btn-submit">送信</button>
            <button type="submit" name="back" value="true" class="btn-back">修正</button>
        </div>
    </form>
</main>
@endsection