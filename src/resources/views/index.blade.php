@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('title', 'Contact')

@section('content')
        <div class="contact-form__content">
            <form class="form" action="/confirm" method="post">
            @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お名前</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input-name">
                            <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                            <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                        </div>
                        <div class="form__error">
                            @error('last_name')
                                {{ $message }}
                            @enderror
                            @error('first_name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">性別</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--radio">
                            <label>
                                <input type="radio" name="gender" value="男性" {{ old('gender', '男性') == '男性' ? 'checked' : '' }}>
                                <span class="form__input--radio-label">男性</span>
                            </label>
                            <label>
                                <input type="radio" name="gender" value="女性" {{ old('gender') == '女性' ? 'checked' : '' }}>
                                <span class="form__input--radio-label">女性</span>
                            </label>
                            <label>
                                <input type="radio" name="gender" value="その他" {{ old('gender') == 'その他' ? 'checked' : '' }}>
                                <span class="form__input--radio-label">その他</span>
                            </label>
                        </div>
                        <div class="form__error">
                            @error('gender')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                        </div>
                        <div class="form__error">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">電話番号</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input-tel">
                            <input type="tel" name="tel1" placeholder="090" value="{{ old('tel1') }}"> -
                            <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}"> -
                            <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                        </div>
                        <div class="form__error">
                            @error('tel_group')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">住所</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                        </div>
                        <div class="form__error">
                            @error('address')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">建物</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                        </div>
                        <div class="form__error">
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせの種類</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__item-select">
                            <select name="category_id" value="{{ old('category_id') }}">
                                <option value="">選択してください</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category['content'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form__error">
                            <div class="form__error-detail">
                                @error('category_id')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせ内容</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--textarea">
                            <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                        </div>
                        <div class="form__error">
                            @error('detail')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>
            </form>
        </div>
@endsection
