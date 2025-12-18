<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Course;
use Illuminate\Http\Request;
class PostController extends Controller
{
    // Exporta todos los posts (alumnos) a un archivo CSV
    public function exportCsv()
    {
        $posts = Post::with('course')->get();
        $filename = 'posts_' . date('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];
        $callback = function() use ($posts) {
            $handle = fopen('php://output', 'w');
            // Encabezados
            fputcsv($handle, ['ID', 'Title', 'Name', 'Email', 'Age', 'Course']);
            foreach ($posts as $post) {
                fputcsv($handle, [
                    $post->id,
                    $post->title,
                    $post->name,
                    $post->email,
                    $post->age,
                    $post->course?->name ?? 'Sin Asignar',
                ]);
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    }
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }
    public function create()
    {
        $courses = Course::all();
        return view('posts.create', compact('courses'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'age' => 'required|integer',
            'course_id' => 'required|exists:courses,id',
        ]);
        Post::create($request->all());
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    public function edit(Post $post)
    {
        $courses = Course::all();
        return view('posts.edit', compact('post', 'courses'));
    }
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'age' => 'required|integer',
            'course_id' => 'required|exists:courses,id',
        ]);
        $post->update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}