@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2>Bienvenido, {{ Auth::user()->name }}!</h2>
                </div>
                <div class="card-body">
                    <p class="lead">Accede a las siguientes secciones:</p>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Cursos</h5>
                                    <p class="card-text">Gestiona los cursos disponibles</p>
                                    <a href="{{ route('courses.index') }}" class="btn btn-primary">Ver Cursos</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Alumnos/Posts</h5>
                                    <p class="card-text">Gestiona los alumnos registrados</p>
                                    <a href="{{ route('posts.index') }}" class="btn btn-primary">Ver Alumnos</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Información de tu cuenta</h5>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Nombre:</strong> {{ Auth::user()->name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Email:</strong> {{ Auth::user()->email }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Miembro desde:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
