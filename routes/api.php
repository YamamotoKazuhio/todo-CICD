<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\ToDoDetailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 標準的なリソースルートのみの状態
Route::apiResource('toDos', ToDoController::class);
Route::apiResource('toDoDetails', ToDoDetailController::class);