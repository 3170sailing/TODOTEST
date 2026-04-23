@extends('layouts.app')

@section('css')
    {{-- categoryページ専用のCSS --}}
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
    {{-- 成功メッセージ --}}
    @if (session('message'))
        <div class="category__alert category__alert--success">
            {{ session('message') }}
        </div>
    @endif

    {{-- バリデーションエラー --}}
    @if ($errors->any())
        <div class="category__alert category__alert--danger">
            <ul class="category__alert--danger-list">
                @foreach ($errors->all() as $error)
                    <li class="category__alert--danger-item">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="category__content">
        {{-- カテゴリ作成フォーム --}}
        <form class="create-form" action="/categories" method="post">
            @csrf

            <div class="create-form__item">
                {{-- 入力値を保持 --}}
                <input
                    class="create-form__item-input"
                    type="text"
                    name="name"
                    value="{{ old('name') }}">
            </div>

            <div class="create-form__button">
                <button class="create-form__button-submit" type="submit">
                    作成
                </button>
            </div>
        </form>

        {{-- 見出し --}}
        <div class="category-table__heading">
            <h2 class="category-table__heading-text">category</h2>
        </div>

        {{-- カテゴリ一覧 --}}
        <div class="category-table">
            <table class="category-table__inner">
                @foreach ($categories as $category)
                    <tr class="category-table__row">
                        <td class="category-table__item category-table__item--content">
                            {{-- 更新フォーム --}}
                            <form class="update-form" action="/categories/update" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $category->id }}">

                                <div class="update-form__group">
                                    <input
                                        class="update-form__item-input"
                                        type="text"
                                        name="name"
                                        value="{{ $category->name }}">
                                </div>

                                <div class="update-form__button">
                                    <button class="update-form__button-submit" type="submit">
                                        更新
                                    </button>
                                </div>
                            </form>
                        </td>

                        <td class="category-table__item category-table__item--button">
                            {{-- 削除フォーム --}}
                            <form class="delete-form" action="/categories/delete" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $category->id }}">

                                <div class="delete-form__button">
                                    <button class="delete-form__button-submit" type="submit">
                                        削除
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection