<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * 認可
     */
    public function authorize()
    {
        return true;
    }

    /**
     * バリデーションルール
     */
    public function rules()
    {
        return [
            // カテゴリ名は必須、10文字以内
            'name' => ['required', 'string', 'max:10'],
        ];
    }

    /**
     * エラーメッセージ
     */
    public function messages()
    {
        return [
            'name.required' => 'カテゴリ名を入力してください',
            'name.max' => 'カテゴリ名は10文字以内で入力してください',
        ];
    }
}