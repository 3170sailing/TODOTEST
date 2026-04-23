<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * カテゴリ一覧表示
     */
    public function index()
    {
        // カテゴリ一覧を取得
        $categories = Category::all();

        // category.blade.php に渡す
        return view('category', compact('categories'));
    }

    /**
     * カテゴリ追加
     */
    public function store(CategoryRequest $request)
    {
        // 入力されたカテゴリ名だけ取得
        $category = $request->only(['name']);

        // categoriesテーブルに保存
        Category::create($category);

        return redirect('/categories')->with('message', 'カテゴリを作成しました');
    }

    /**
     * カテゴリ更新
     */
    public function update(CategoryRequest $request)
    {
        // 更新するカテゴリ名だけ取得
        $category = $request->only(['name']);

        // 指定されたidのカテゴリを更新
        Category::find($request->id)->update($category);

        return redirect('/categories')->with('message', 'カテゴリを更新しました');
    }

    /**
     * カテゴリ削除
     */
    public function destroy(Request $request)
    {
        // 指定されたidのカテゴリを削除
        Category::find($request->id)->delete();

        return redirect('/categories')->with('message', 'カテゴリを削除しました');
    }
}