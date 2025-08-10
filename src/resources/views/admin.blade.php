@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('button')
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">logout</button>
    </form>
@endsection

@section('title', 'Admin')

@section('content')
<div class="search-bar">
    <form class="search-bar__form" method="GET" action="{{ url('/admin') }}">
        <input type="text" name="keyword" class="search-bar__input" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

        <select class="search-bar__gender" name="gender">
            <option value="" disabled {{ is_null(request('gender')) ? 'selected' : '' }}>性別</option>
            <option value="男性" {{ request('gender') === '男性' ? 'selected' : '' }}>男性</option>
            <option value="女性" {{ request('gender') === '女性' ? 'selected' : '' }}>女性</option>
            <option value="その他" {{ request('gender') === 'その他' ? 'selected' : '' }}>その他</option>
        </select>

        <select class="search-bar__category" name="category">
            <option value="" disabled {{ is_null(request('category')) ? 'selected' : '' }}>お問い合わせの種類</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>

        <input class="search-bar__date" type="date" name="registered_date" id="custom-date" value="{{ request('registered_date') }}">

        <button type="submit" class="search-bar__button search-bar__button--search">検索</button>
        <a href="/admin" class="search-bar__button search-bar__button--reset">リセット</a>
    </form>
</div>

<div class="admin-header">
    <button class="export-button">エクスポート</button>
    {{ $contacts->onEachSide(1)->links('vendor.pagination.custom') }}
</div>

<table>
    <tr>
        <th>お名前</th>
        <th>性別</th>
        <th>メールアドレス</th>
        <th>お問い合わせの種類</th>
        <th></th>
    </tr>
    @foreach ($contacts as $contact)
    <tr>
        <td>{{$contact->last_name}}&emsp;{{$contact->first_name}}</td>
        <td>{{$contact->gender}}</td>
        <td>{{$contact->email}}</td>
        <td>{{$contact->category->content}}</td>
        <td>
            <button class="detail-button" data-id="{{ $contact->id }}">詳細</button>
        </td>
    </tr>

    <div id="modal-{{ $contact->id }}" class="modal">
        <div class="modal__content">
            <span class="close" data-id="{{ $contact->id }}">&times;</span>
            <div class="modal__table">
                <div class="modal__row">
                    <div class="modal__label">お名前</div>
                    <div class="modal__value">{{ $contact->last_name }}&emsp;{{ $contact->first_name }}</div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">性別</div>
                    <div class="modal__value">{{ $contact->gender }}</div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">メールアドレス</div>
                    <div class="modal__value">{{ $contact->email }}</div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">電話番号</div>
                    <div class="modal__value">{{ $contact->tel }}</div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">住所</div>
                    <div class="modal__value">{{ $contact->address }}</div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">建物</div>
                    <div class="modal__value">{{ $contact->building }}</div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">お問い合わせの種類</div>
                    <div class="modal__value">{{ $contact->category->content }}</div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">お問い合わせ内容</div>
                    <div class="modal__value">{{ $contact->detail }}</div>
                </div>
            </div>

            <div class="modal__footer">
                <form method="POST" action="{{ route('contacts.destroy', $contact->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal__delete-button">削除</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</table>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.detail-button');
        const closes = document.querySelectorAll('.close');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const modal = document.getElementById(`modal-${id}`);
                modal.style.display = 'block';
            });
        });

        closes.forEach(close => {
            close.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const modal = document.getElementById(`modal-${id}`);
                modal.style.display = 'none';
            });
        });

        window.addEventListener('click', function (e) {
            document.querySelectorAll('.modal').forEach(modal => {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const dateInput = document.getElementById('custom-date');

        dateInput.addEventListener('click', function () {
            if (dateInput.showPicker) {
                dateInput.showPicker();
            }
        });
    });
</script>
@endsection