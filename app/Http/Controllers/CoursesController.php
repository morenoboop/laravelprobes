<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;


class CoursesController extends Controller
{

    public function exportCsv()
    {
        $courses = Course::all();
        $filename = 'courses_' . date('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];
        $callback = function() use ($courses) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Name', 'Description']);
            foreach ($courses as $course) {
                fputcsv($handle, [$course->id, $course->name, $course->description]);
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function index()
    {
        $courses = Course::latest()->paginate(10); 
        
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required', 
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Curso creado exitosamente.');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Curso actualizado exitosamente.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Curso eliminado exitosamente.');
    }
    
    // El método 'show' para ver detalles (si lo necesitas)
    public function show(Course $course)
    {
        // Puedes crear una vista 'courses.show'
        return view('courses.show', compact('course'));
    }
}