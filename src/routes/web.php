<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Todo一覧表示
Route::get('/', [TodoController::class, 'index']);

//Todo追加
Route::post('/todos', [TodoController::class, 'store']);

// 更新
Route::patch('/todos/update', [TodoController::class, 'update']);

// 削除
Route::post('/categories/delete', [CategoryController::class, 'destroy']);

// カテゴリー追加
Route::get('/categories', [CategoryController::class, 'index']);

Route::post('/categories', [CategoryController::class, 'store']);

Route::get('/todos/search', [TodoController::class, 'search']);

Route::post('/categories/update', [CategoryController::class, 'update']);
