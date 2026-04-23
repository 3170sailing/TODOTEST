<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            // Todo内容は必須、20文字以内
            'content' => ['required', 'string', 'max:20'],

            // カテゴリは必須
            'category_id' => ['required'],
        ];
    }

    /**
     * エラーメッセージ
     */
    public function messages()
    {
        return [
            'content.required' => 'Todoを入力してください',
            'content.max' => 'Todoは20文字以内で入力してください',
            'category_id.required' => 'カテゴリを選択してください',
        ];
    }
}