@extends('layouts.app')

@section('content')
<h2>Edit Post</h2>
<form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" value="{{ $post->title }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Content</label>
        <textarea name="content" class="form-control" required>{{ $post->content }}</textarea>
    </div>
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ $post->name }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $post->email }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" value="{{ $post->password }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Age</label>
        <input type="number" name="age" value="{{ $post->age }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Clase Asignada</label>
        <select name="course_id" class="form-control" required>
            <option value="">-- Seleccionar Clase --</option>
            @foreach ($courses as $course)
                <option value="{{ $course->id }}"
                    {{-- Lógica para seleccionar el curso actual --}}
                    {{ $post->course_id == $course->id ? 'selected' : '' }}>
                    {{ $course->name }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection