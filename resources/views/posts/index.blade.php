@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Alumnos</h2>
    <div>
        <a class="btn btn-info me-2" href="{{ route('courses.index') }}">📚 Ver Cursos</a>
        <a class="btn btn-success me-2" href="{{ route('posts.export.csv') }}">Exportar CSV</a>
        <a class="btn btn-primary" href="{{ route('posts.create') }}">Agregar Alumno</a>
    </div>
</div>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Edad</th>
        <th>Curso Asignado</th>
        <th>Acciones</th>
    </tr>
    @foreach ($posts as $post)
    <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->title }}</td>
        <td>{{ $post->name}}</td>
        <td>{{ $post->email}}</td>
        <td>{{ $post->age}}</td>
        <td>
            {{ $post->course?->name ?? 'Sin Asignar' }} 
        </td>
        <td>
            <a class="btn btn-info btn-sm" href="{{ route('posts.show', $post) }}">Ver</a>
            <a class="btn btn-warning btn-sm" href="{{ route('posts.edit', $post) }}">Editar</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{{ $posts->links() }}
@endsection