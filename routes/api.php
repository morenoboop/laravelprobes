<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiPostController;
use App\Http\Controllers\ApiCourseController;

// Posts API Routes
Route::get('/posts', [ApiPostController::class, 'index']);           // GET - Obtener todos los posts
Route::get('/posts/{id}', [ApiPostController::class, 'show']);      // GET - Obtener un post por ID
Route::post('/posts', [ApiPostController::class, 'store']);         // POST - Crear un nuevo post
Route::put('/posts/{id}', [ApiPostController::class, 'update']);    // PUT - Actualizar un post
Route::patch('/posts/{id}', [ApiPostController::class, 'update']);  // PATCH - Actualizar un post (parcial)
Route::delete('/posts/{id}', [ApiPostController::class, 'destroy']); // DELETE - Eliminar un post

// Courses API Routes
Route::get('/courses', [ApiCourseController::class, 'index']);           // GET - Obtener todos los cursos
Route::get('/courses/{id}', [ApiCourseController::class, 'show']);      // GET - Obtener un curso por ID
Route::post('/courses', [ApiCourseController::class, 'store']);         // POST - Crear un nuevo curso
Route::put('/courses/{id}', [ApiCourseController::class, 'update']);    // PUT - Actualizar un curso
Route::patch('/courses/{id}', [ApiCourseController::class, 'update']);  // PATCH - Actualizar un curso (parcial)
Route::delete('/courses/{id}', [ApiCourseController::class, 'destroy']); // DELETE - Eliminar un curso
