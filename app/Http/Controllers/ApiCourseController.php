<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiCourseController extends Controller
{
    /**
     * GET /api/courses - Obtener todos los cursos
     */
    public function index()
    {
        try {
            $courses = Course::with('posts')->get();
            
            return response()->json([
                'success' => true,
                'message' => 'Cursos obtenidos correctamente',
                'data' => $courses,
                'count' => $courses->count()
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los cursos',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * GET /api/courses/{id} - Obtener un curso específico
     */
    public function show($id)
    {
        try {
            $course = Course::with('posts')->find($id);
            
            if (!$course) {
                return response()->json([
                    'success' => false,
                    'message' => 'Curso no encontrado',
                    'data' => null
                ], Response::HTTP_NOT_FOUND);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Curso obtenido correctamente',
                'data' => $course
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el curso',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * POST /api/courses - Crear un nuevo curso
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:courses,name',
                'description' => 'required|string',
            ]);

            $course = Course::create($validated);
            $course->load('posts');

            return response()->json([
                'success' => true,
                'message' => 'Curso creado correctamente',
                'data' => $course
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
                'message' => 'Error al crear el curso',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * PUT/PATCH /api/courses/{id} - Actualizar un curso
     */
    public function update(Request $request, $id)
    {
        try {
            $course = Course::find($id);
            
            if (!$course) {
                return response()->json([
                    'success' => false,
                    'message' => 'Curso no encontrado',
                    'data' => null
                ], Response::HTTP_NOT_FOUND);
            }

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255|unique:courses,name,' . $id,
                'description' => 'sometimes|required|string',
            ]);

            $course->update($validated);
            $course->load('posts');

            return response()->json([
                'success' => true,
                'message' => 'Curso actualizado correctamente',
                'data' => $course
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
                'message' => 'Error al actualizar el curso',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * DELETE /api/courses/{id} - Eliminar un curso
     */
    public function destroy($id)
    {
        try {
            $course = Course::find($id);
            
            if (!$course) {
                return response()->json([
                    'success' => false,
                    'message' => 'Curso no encontrado',
                    'data' => null
                ], Response::HTTP_NOT_FOUND);
            }

            $course->delete();

            return response()->json([
                'success' => true,
                'message' => 'Curso eliminado correctamente',
                'data' => null
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el curso',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
