<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiPostController extends Controller
{
    /**
     * GET /api/posts - Obtener todos los posts
     */
    public function index()
    {
        try {
            $posts = Post::with('course')->get();
            
            return response()->json([
                'success' => true,
                'message' => 'Posts obtenidos correctamente',
                'data' => $posts,
                'count' => $posts->count()
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los posts',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * GET /api/posts/{id} - Obtener un post específico
     */
    public function show($id)
    {
        try {
            $post = Post::with('course')->find($id);
            
            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post no encontrado',
                    'data' => null
                ], Response::HTTP_NOT_FOUND);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Post obtenido correctamente',
                'data' => $post
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el post',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * POST /api/posts - Crear un nuevo post
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:6',
                'age' => 'required|integer|min:1|max:150',
                'course_id' => 'required|exists:courses,id',
            ]);

            $post = Post::create($validated);
            $post->load('course');

            return response()->json([
                'success' => true,
                'message' => 'Post creado correctamente',
                'data' => $post
            ], Response::HTTP_CREATED);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el post',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * PUT/PATCH /api/posts/{id} - Actualizar un post
     */
    public function update(Request $request, $id)
    {
        try {
            $post = Post::find($id);
            
            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post no encontrado',
                    'data' => null
                ], Response::HTTP_NOT_FOUND);
            }

            $validated = $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'content' => 'sometimes|required|string',
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|max:255',
                'password' => 'sometimes|required|string|min:6',
                'age' => 'sometimes|required|integer|min:1|max:150',
                'course_id' => 'sometimes|required|exists:courses,id',
            ]);

            $post->update($validated);
            $post->load('course');

            return response()->json([
                'success' => true,
                'message' => 'Post actualizado correctamente',
                'data' => $post
            ], Response::HTTP_OK);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el post',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * DELETE /api/posts/{id} - Eliminar un post
     */
    public function destroy($id)
    {
        try {
            $post = Post::find($id);
            
            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post no encontrado',
                    'data' => null
                ], Response::HTTP_NOT_FOUND);
            }

            $post->delete();

            return response()->json([
                'success' => true,
                'message' => 'Post eliminado correctamente',
                'data' => null
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el post',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
