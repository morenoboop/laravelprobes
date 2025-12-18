@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Cursos</h2>
    <div>
        <a class="btn btn-info me-2" href="{{ route('posts.index') }}">📋 Ver Alumnos</a>
        <a class="btn btn-success me-2" href="{{ route('courses.export.csv') }}">Exportar CSV</a>
        <a class="btn btn-primary" href="{{ route('courses.create') }}">Crear Curso</a>
    </div>
</div>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Acciones</th>
    </tr>
    @foreach ($courses as $course)
    <tr>
        <td>{{ $course->id }}</td>
        <td>{{ $course->name}}</td>
        <td>{{ $course->description}}</td>
        <td>
            <a class="btn btn-info btn-sm" href="{{ route('courses.show', $course) }}">Ver</a>
            <a class="btn btn-warning btn-sm" href="{{ route('courses.edit', $course) }}">Editar</a>
            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{{--{{ $course->links() }}--}}
@endsection