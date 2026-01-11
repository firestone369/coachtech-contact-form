@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header-right')
<a href="{{ route('register') }}" class="header-btn">register</a>
@endsection

@section('content')
<div class="login-page">
    <h2 class="page-title">Login</h2>

    <div class="login-card">
        <form action="/login" method="post">
            @csrf

            <table class="login-table">
                <tr>
                    <th>メールアドレス</th>
                </tr>
                <tr>
                    <td>
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="例）test@example.com" class="login-input">
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
                        <input type="password" name="password"
                            placeholder="例）coachtech2026" class="login-input">
                        @error('password')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>
            </table>


            <div class="login-actions">
                <button type="submit" class="login-btn">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection