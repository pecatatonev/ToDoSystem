<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontEnd\FAuthController;
use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\TodoController as ApiTodoController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [ApiAuthController::class, 'register'])->name('register.api');
Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');

    Route::get('/todos', [ApiTodoController::class, 'index'])->name('todos.index.api');
    Route::post('/todos', [ApiTodoController::class, 'store'])->name('todos.store.api');
    Route::put('/todos/{todo}', [ApiTodoController::class, 'update'])->name('todos.update.api');
    Route::delete('/todos/{todo}', [ApiTodoController::class, 'destroy'])->name('todos.destroy.api');
    Route::patch('/todos/{todo}/toggle', [ApiTodoController::class, 'toggle'])->name('todos.toggle.api');
    Route::get('/todos/{todo}', [ApiTodoController::class, 'show'])->name('todos.show.api');

    Route::get('/categories', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
    Route::post('/categories', [\App\Http\Controllers\Api\CategoryController::class, 'store']);
});