<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController;
use App\Http\Middleware\ApiSessionAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', fn() => view('auth.register'))->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', fn() => view('auth.login'))->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::middleware([ApiSessionAuth::class])->group(function () {
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::get('/todos/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit');
    Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
    Route::put('/todos/{id}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
    Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


