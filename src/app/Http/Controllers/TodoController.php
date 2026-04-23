<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\Category;

class TodoController extends Controller
{
    /**
     * Todo一覧表示
     */
    public function index()
    {
        // 作成日の新しい順でTodoを取得
        // categoryも一緒に取得して、view側でカテゴリ名を表示できるようにする
        $todos = Todo::with('category')->orderBy('created_at', 'desc')->get();

        // カテゴリ一覧を取得
        $categories = Category::all();

        // index.blade.php に渡す
        return view('index', compact('todos', 'categories'));
    }

    /**
     * Todo追加
     */
    public function store(TodoRequest $request)
{
    // content と category_id を取得して保存
    $todo = $request->only(['content', 'category_id']);
    Todo::create($todo);

    return redirect('/')->with('message', 'Todoを作成しました');
}

    /**
     * Todo更新
     */
    public function update(TodoRequest $request)
    {
        // 更新する値を取得
        // 今回の要件に合わせて content を更新
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

    /**
 * Todo検索
 */
public function search(Request $request)
{
    // Todoとカテゴリを一緒に取得できるようにする
    $query = Todo::with('category');

    // キーワードが入力されている場合
    if (!empty($request->keyword)) {
        $query->where('content', 'like', '%' . $request->keyword . '%');
    }

    // カテゴリが選択されている場合
    if (!empty($request->category_id)) {
        $query->where('category_id', $request->category_id);
    }

    // 検索結果を取得
    $todos = $query->orderBy('created_at', 'desc')->get();

    // カテゴリ一覧を取得
    $categories = Category::all();

    return view('index', compact('todos', 'categories'));
}
}