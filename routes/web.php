<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\AuthController;

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post')->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post')->middleware('guest');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Rutas de cursos y posts
    Route::get('courses/export/csv', [CoursesController::class, 'exportCsv'])->name('courses.export.csv');
    Route::get('posts/export/csv', [PostController::class, 'exportCsv'])->name('posts.export.csv');
    Route::resource('posts', PostController::class);
    Route::resource('courses', CoursesController::class);
});