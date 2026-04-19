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
                </div>

                <div class="create-form__button">
                    <button class="create-form__button-submit" type="submit">
                        作成
                    </button>
                </div>
            </form>
        </div>

        {{-- Todo一覧テーブル --}}
        <div class="todo__table">
            <table class="todo-table">
                <tr class="todo-table__row">
                    <th class="todo-table__header">Todo</th>
                    <th class="todo-table__header"></th>
                    <th class="todo-table__header"></th>
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