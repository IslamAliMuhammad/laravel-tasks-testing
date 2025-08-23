<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index']);
    Route::post('/tasks', [App\Http\Controllers\TaskController::class, 'store']);
    Route::put('/tasks/{task}', [App\Http\Controllers\TaskController::class, 'update']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

