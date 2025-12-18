@extends('layouts.app')

@section('content')
<h2>Create Post</h2>
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Content</label>
        <textarea name="content" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Age</label>
        <input type="number" name="age" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <div class="mb-3">
        <label>Clase Asignada</label>
        <select name="course_id" class="form-control" required>
            <option value="">-- Seleccionar Clase --</option>
            @foreach ($courses as $course)
                <option value="{{ $course->id }}">
                    {{ $course->name }}
                </option>
            @endforeach
        </select>
    </div>
</form>
@endsection