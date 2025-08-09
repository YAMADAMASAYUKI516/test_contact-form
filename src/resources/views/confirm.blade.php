@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('title', 'Confirm')

@section('content')
        <div class="confirm__content">
            <form class="form" action="/thanks" method="POST">
                @csrf
                <div class="confirm-table">
                    <table class="confirm-table__inner">
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お名前</th>
                            <td class="confirm-table__text">
                                <input type="text" name="name" value="{{ $contact['last_name'] }}&emsp;{{ $contact['first_name'] }}" readonly>
                                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">性別</th>
                            <td class="confirm-table__text">
                                <input type="text" name="gender" value="{{ $contact['gender'] }}" readonly>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">メールアドレス</th>
                            <td class="confirm-table__text">
                                <input type="email" name="email" value="{{ $contact['email'] }}" readonly>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">電話番号</th>
                            <td class="confirm-table__text">
                                <input type="tel" name="tel" value="{{ $contact['tel1'] }}-{{ $contact['tel2'] }}-{{ $contact['tel3'] }}" readonly>
                                <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
                                <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                                <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">住所</th>
                            <td class="confirm-table__text">
                                <input type="text" name="address" value="{{ $contact['address'] }}" readonly>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">建物</th>
                            <td class="confirm-table__text">
                                <input type="text" name="building" value="{{ $contact['building'] }}" readonly>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせの種類</th>
                            <td class="confirm-table__text">
                                <input type="text" name="content" value="{{ $contact['content'] }}" readonly>
                                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                            </td>
                        </tr>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせ内容</th>
                            <td class="confirm-table__text">
                                <textarea type="text" name="detail" readonly>{{ $contact['detail'] }}</textarea>
                                <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">送信</button>
                    <button class="form__button-back" type="submit" name='back' value="back">修正</button>
                </div>
        </div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.confirm-table__text textarea').forEach(textarea => {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        });
    });
</script>
@endsection