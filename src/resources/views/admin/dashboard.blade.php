@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection

@section('header-right')
<form action="{{ route('logout') }}" method="post" class="header-logout">
    @csrf
    <button type="submit" class="header-btn">logout</button>
</form>
@endsection

@section('content')
<div class="admin-page">
    <h2 class="page-title">Admin</h2>

    <form action="/search" method="get" class="search-form">
        <table class="search-table">
            <tr>
                <td class="w-keyword">
                    <input
                        type="text"
                        name="keyword"
                        value="{{ request('keyword') }}"
                        class="search-input"
                        placeholder="名前やメールアドレスを入力してください">
                </td>

                <td class="w-gender">
                    <select name="gender" class="search-select">
                        <option value="">性別</option>
                        <option value="1" {{ request('gender') === '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ request('gender') === '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ request('gender') === '3' ? 'selected' : '' }}>その他</option>
                    </select>
                </td>

                <td class="w-category">
                    <select name="category_id" class="search-select">
                        <option value="">お問い合わせの種類</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                        @endforeach
                    </select>
                </td>

                <td class="w-date">
                    <input
                        type="date"
                        name="date"
                        value="{{ request('date') }}"
                        class="search-input">
                </td>

                <td class="w-btn">
                    <button type="submit" class="btn btn-search">検索</button>
                </td>

                <td class="w-btn">
                    <a href="/reset" class="btn btn-reset">リセット</a>
                </td>
            </tr>
        </table>
    </form>

    <div class="sub-row">
        <a href="{{ url('/admin/export') . '?' . http_build_query(request()->except('page')) }}"
            class="btn btn-export">
            エクスポート
        </a>


        <div class="pagination-wrap">
            {{ $contacts->appends(request()->query())->links('vendor.pagination.admin-numbers') }}
        </div>
    </div>

    <table class="list-table">
        <thead>
            <tr>
                <th class="col-name">お名前</th>
                <th class="col-gender">性別</th>
                <th class="col-email">メールアドレス</th>
                <th class="col-category">お問い合わせの種類</th>
                <th class="col-actions"></th>
            </tr>
        </thead>

        <tbody>
            @forelse($contacts as $contact)
            @php
            $genderLabel = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');
            $categoryLabel = $contact->category?->content ?? '';
            $nameLabel = trim(($contact->last_name ?? '') . ' ' . ($contact->first_name ?? ''));
            @endphp

            <tr>
                <td>{{ $nameLabel }}</td>

                <td>{{ $genderLabel }}</td>

                <td>{{ $contact->email }}</td>

                <td>{{ $categoryLabel }}</td>

                <td class="actions">
                    <button
                        type="button"
                        class="btn btn-detail"

                        data-id="{{ $contact->id }}"
                        data-name="{{ e($nameLabel) }}"
                        data-gender="{{ e($genderLabel) }}"
                        data-email="{{ e($contact->email) }}"
                        data-category="{{ e($categoryLabel) }}"
                        data-tel="{{ e(str_replace('-', '', (string)$contact->tel)) }}"
                        data-address="{{ e((string)$contact->address) }}"
                        data-building="{{ e((string)$contact->building) }}"
                        data-detail="{{ e((string)$contact->detail) }}"
                        data-created="{{ optional($contact->created_at)->format('Y-m-d') }}">
                        詳細
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="empty">該当データがありません</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('modal.contact-detail')

<script src="{{ asset('js/modal.js') }}" defer></script>
@endsection