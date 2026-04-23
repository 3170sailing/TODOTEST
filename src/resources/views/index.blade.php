@extends('layouts.app')

@section('css')
    {{-- indexページ専用のCSS --}}
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    {{-- 成功メッセージの表示 --}}
    @if (session('message'))
        <div class="todo__alert todo__alert--success">
            {{ session('message') }}
        </div>
    @endif

    {{-- バリデーションエラーメッセージの表示 --}}
    @if ($errors->any())
        <div class="todo__alert todo__alert--danger">
            <ul class="todo__alert--danger-list">
                @foreach ($errors->all() as $error)
                    <li class="todo__alert--danger-item">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="todo__content">
        <div class="section__title">
            <h2>新規作成</h2>
        </div>
        {{-- Todo追加フォーム --}}
        <div class="todo__create">
            <form class="create-form" action="/todos" method="post">
                @csrf

                <div class="create-form__item">
                    {{-- old('content')で、バリデーションエラー時に入力値を保持 --}}
                    <input
                        class="create-form__item-input"
                        type="text"
                        name="content"
                        value="{{ old('content') }}">
                    <select class="create-form__item-select" name="category_id">
                        <option value="">カテゴリー</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="create-form__button">
                    <button class="create-form__button-submit" type="submit">
                        作成
                    </button>
                </div>
            </form>
            <div class="section__title">
    <h2>Todo検索</h2>
</div>

<form class="search-form" action="/todos/search" method="get">
    <div class="search-form__item">
        {{-- キーワード検索 --}}
        <input
            class="search-form__item-input"
            type="text"
            name="keyword"
            value="{{ request('keyword') }}">

        {{-- カテゴリ検索 --}}
        <select class="search-form__item-select" name="category_id">
            <option value="">カテゴリー</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="search-form__button">
        <button class="search-form__button-submit" type="submit">検索</button>
    </div>
</form>
        </div>

        {{-- Todo一覧テーブル --}}
        <div class="todo__table">
            <table class="todo-table">
                <tr class="todo-table__row">
                    <th class="todo-table__header">
                        <span class="todo-table__header-span">Todo</span>
                        <span class="todo-table__header-span">カテゴリ</span>
                    </th>
                </tr>

                {{-- コントローラから渡された$todosを1件ずつ表示 --}}
                @foreach ($todos as $todo)
                    <tr class="todo-table__row">
                        {{-- 更新フォーム --}}
                        <td class="todo-table__item">
                            <form class="update-form" action="/todos/update" method="post">
                                @csrf
                                @method('PATCH')

                                {{-- 更新するTodoのidを送る --}}
                                <input type="hidden" name="id" value="{{ $todo->id }}">

                                <div class="update-form__item">
                                    <input
                                        class="update-form__item-input"
                                        type="text"
                                        name="content"
                                        value="{{ $todo->content }}">
                                </div>
                                <div class="update-form__item">
                                    <p class="update-form__item-p">{{ optional($todo->category)->name }}</p>
                                </div>
                                <div class="update-form__button">
                                    <button class="update-form__button-submit" type="submit">
                                        更新
                                    </button>
                                </div>
                            </form>
                        </td>

                        {{-- 削除フォーム --}}
                        <td class="todo-table__item">
                            <form class="delete-form" action="/todos/delete" method="post">
                                @csrf
                                @method('DELETE')

                                {{-- 削除するTodoのidを送る --}}
                                <input type="hidden" name="id" value="{{ $todo->id }}">

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