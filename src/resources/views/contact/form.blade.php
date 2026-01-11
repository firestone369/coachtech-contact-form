@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<main class="contact">
    <h2 class="contact-title">Contact</h2>

    <form action="/contact/confirm" method="post" class="contact-form">
        @csrf

        <table class="contact-table">
            <tr>
                <th>お名前 <span class="required">※</span></th>
                <td>
                    <div class="input-flex">
                        <div class="field-block">
                            <input
                                type="text"
                                name="last_name"
                                value="{{ old('last_name', '') }}"
                                placeholder="例）山田"
                                autocomplete="family-name">
                            @error('last_name')
                            <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-block">
                            <input
                                type="text"
                                name="first_name"
                                value="{{ old('first_name', '') }}"
                                placeholder="例）太郎"
                                autocomplete="given-name">
                            @error('first_name')
                            <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <th>性別 <span class="required">※</span></th>
                <td>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="gender" value="1" {{ (string)old('gender') === '1' ? 'checked' : '' }}>
                            男性
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="gender" value="2" {{ (string)old('gender') === '2' ? 'checked' : '' }}>
                            女性
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="gender" value="3" {{ (string)old('gender') === '3' ? 'checked' : '' }}>
                            その他
                        </label>
                    </div>
                    @error('gender')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </td>
            </tr>

            <tr>
                <th>メールアドレス <span class="required">※</span></th>
                <td>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', '') }}"
                        placeholder="例）test@example.com"
                        class="input-full"
                        autocomplete="email">
                    @error('email')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </td>
            </tr>

            <tr>
                <th>電話番号 <span class="required">※</span></th>
                <td>
                    <div class="tel-flex">
                        <div class="field-block">
                            <input
                                type="text"
                                name="tel1"
                                value="{{ old('tel1', '') }}"
                                placeholder="080"
                                inputmode="numeric"
                                autocomplete="tel-national">
                        </div>

                        <span class="hyphen">-</span>

                        <div class="field-block">
                            <input
                                type="text"
                                name="tel2"
                                value="{{ old('tel2', '') }}"
                                placeholder="1234"
                                inputmode="numeric">
                        </div>

                        <span class="hyphen">-</span>

                        <div class="field-block">
                            <input
                                type="text"
                                name="tel3"
                                value="{{ old('tel3', '') }}"
                                placeholder="5678"
                                inputmode="numeric">
                        </div>
                    </div>

                    {{-- 電話番号のエラーは「tel1」に1つだけ表示する --}}
                    @error('tel1')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </td>
            </tr>

            <tr>
                <th>住所 <span class="required">※</span></th>
                <td>
                    <input
                        type="text"
                        name="address"
                        value="{{ old('address', '') }}"
                        placeholder="例）東京都渋谷区千駄ヶ谷1-2-3"
                        class="input-full"
                        autocomplete="street-address">
                    @error('address')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </td>
            </tr>

            <tr>
                <th>建物名</th>
                <td>
                    <input
                        type="text"
                        name="building"
                        value="{{ old('building', '') }}"
                        placeholder="例）千駄ヶ谷マンション101"
                        class="input-full">
                    @error('building')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </td>
            </tr>

            <tr>
                <th>お問い合わせの種類 <span class="required">※</span></th>
                <td>
                    <select name="category_id" class="input-full">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ (string)old('category_id') === (string)$category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </td>
            </tr>

            <tr class="textarea-row">
                <th>お問い合わせ内容 <span class="required">※</span></th>
                <td>
                    <textarea
                        name="detail"
                        class="textarea"
                        placeholder="お問い合わせ内容をご記載ください">{{ old('detail', '') }}</textarea>
                    @error('detail')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </td>
            </tr>
        </table>

        <div class="button-area">
            <button type="submit">確認画面</button>
        </div>
    </form>
</main>
@endsection