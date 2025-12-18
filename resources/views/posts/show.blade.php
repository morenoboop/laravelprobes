@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $post->title }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Contenido:</strong></p>
                    <p>{{ $post->content }}</p>
                    
                    <hr>
                    
                    <p><strong>Nombre:</strong> {{ $post->name }}</p>
                    <p><strong>Email:</strong> {{ $post->email }}</p>
                    <p><strong>Edad:</strong> {{ $post->age }}</p>
                    <p><strong>Curso:</strong> {{ $post->course?->name ?? 'Sin Asignar' }}</p>
                    
                    <p><strong>Fecha de Creación:</strong> {{ $post->created_at?->format('d/m/Y H:i') ?? 'N/A' }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
