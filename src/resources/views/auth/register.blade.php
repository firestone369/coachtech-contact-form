@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header-right')
<a href="{{ route('login') }}" class="header-btn">login</a>
@endsection

@section('content')
<div class="register-page">
    <h2 class="page-title">Register</h2>

    <div class="register-card">
        <form action="/register" method="post">
            @csrf

            <table class="register-table">
                <tr>
                    <th>お名前</th>
                </tr>
                <tr>
                    <td>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="例）山田 太郎"
                            class="register-input">
                        @error('name')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <th>メールアドレス</th>
                </tr>
                <tr>
                    <td>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="例）test@example.com"
                            class="register-input">
                        @error('email')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>

                <tr>
                    <th>パスワード</th>
                </tr>
                <tr>
                    <td>
                        <input
                            type="password"
                            name="password"
                            placeholder="例）coachtech2026"
                            class="register-input">
                        @error('password')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>
            </table>

            <div class="register-actions">
                <button type="submit" class="register-btn">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection