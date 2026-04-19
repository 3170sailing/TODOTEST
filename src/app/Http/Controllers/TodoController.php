<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Todo一覧表示
     */
    public function index()
    {
        // 作成日の新しい順でTodoを取得
        $todos = Todo::orderBy('created_at', 'desc')->get();

        // index.blade.php に渡す
        return view('index', compact('todos'));
    }

    /**
     * Todo追加
     */
    public function store(TodoRequest $request)
    {
        // 必要な値だけ取得して保存
        $todo = $request->only(['content']);
        Todo::create($todo);

        return redirect('/')->with('message', 'Todoを作成しました');
    }

    /**
     * Todo更新
     */
    public function update(TodoRequest $request)
    {
        // 更新する値を取得
        $todo = $request->only(['content']);

        // 指定されたidのTodoを更新
        Todo::find($request->id)->update($todo);

        return redirect('/')->with('message', 'Todoを更新しました');
    }

    /**
     * Todo削除
     */
    public function destroy(Request $request)
    {
        // 指定されたidのTodoを削除
        Todo::find($request->id)->delete();

        return redirect('/')->with('message', 'Todoを削除しました');
    }
}