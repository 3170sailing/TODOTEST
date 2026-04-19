<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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
Route::delete('/todos/delete', [TodoController::class, 'destroy']);

