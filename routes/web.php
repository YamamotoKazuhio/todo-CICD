<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| 認証が必要なルートと、認証そのものを行うルートを定義します。
|
*/

// --- 1. 認証が必要なグループ ---
// ログインしていないユーザーがこれら（/ や /api/...）にアクセスすると、
// 自動的にログイン画面（/login）へリダイレクトされます。
Route::middleware(['auth'])->group(function () {

    // メイン画面の表示
    Route::get('/', function () {
        return view('app');
    });

    // React（useGetToDoList.js等）から呼び出されるAPIルート
    Route::prefix('api')->group(function () {
        Route::get('/toDos', [ToDoController::class, 'index']);
        Route::post('/toDos', [ToDoController::class, 'store']);
        Route::put('/toDos/{id}', [ToDoController::class, 'update']);
        Route::delete('/toDos/{id}', [ToDoController::class, 'destroy']);
    });

});

// --- 2. 認証用のルート ---
// login, register, logout, password reset などの設定を読み込みます。
// /visitor/routes/auth.php からコピーしたファイルです。
require __DIR__.'/auth.php';
