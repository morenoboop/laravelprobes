@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $course->name }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Descripción:</strong></p>
                    <p>{{ $course->description }}</p>
                    
                    <p><strong>ID del Curso:</strong> {{ $course->id }}</p>
                    <p><strong>Fecha de Creación:</strong> {{ $course->created_at?->format('d/m/Y H:i') ?? 'N/A' }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
