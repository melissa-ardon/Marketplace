@extends('layouts.app')

@section('content')

    @if (session('mensaje'))
        <div class="alert alert-success d-flex align-items-center position-relative mx-auto d-block" role="alert" style="max-width: 1000px;">
            {{ session('mensaje') }}
            <button type="button" class="btn-close position-absolute top-1 end-0" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container" style="max-width: 1000px; margin-top: 20px;">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Perfil de Usuario</h5>
            </div>
            <div class="card-body">

                <div class="mb-3">
                    <h6><b>Nombre:</b></h6>
                    <p>{{ $user->name }}</p>
                </div>
                <div class="mb-3">
                    <h6><b>Correo Electrónico:</b></h6>
                    <p>{{ $user->email }}</p>
                </div>
            </div>
            
            <div class="card-footer text-center">
                <a href="{{ route('book.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>

        <h5 class="mt-4">Comentarios y Puntuaciones</h5>
        @if ($ratings->isEmpty())
            <p class="text-muted">No hay comentarios ni puntuaciones para este usuario.</p>
        @else
            <div class="list-group">
                @foreach ($ratings as $rating)
                    <div class="list-group-item">
                        <p><strong>Puntuación:</strong> {{ $rating->puntuacion }} / 5</p>
                        <p><strong>Comentario:</strong> {{ $rating->comentario }}</p>
                        <p class="text-muted">
                            <small>Calificado por {{ $rating->calificador->name ?? 'Usuario desconocido' }}</small>
                        </p>
                    </div>
                @endforeach
            </div>
        @endif

        <h5 class="mt-4">Libros Creados por {{ $user->name }}</h5>
        
            <div class="text-end mb-3">
                <a href="{{ route('book.crear') }}" class="btn btn-warning">Crear</a>
            </div>

        @if ($books->isEmpty())
            <p class="text-muted">No hay libros creados por este usuario.</p>
        @else
            <div class="row">
                @foreach ($books as $book)
                    <div class="col-md-4 mb-4">
                        <div class="card border-dark">
                            <div class="card-header bg-dark text-white text-center">
                                <strong>Título: {{ $book->titulo }}</strong>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><strong>Autor:</strong> {{ $book->autor }}</p>
                                <p class="card-text"><strong>Descripción:</strong> {{ $book->descripcion }}</p>
                                <p class="card-text"><strong>Precio:</strong> Lps.{{ $book->precio }}</p>
                                <p class="card-text"><strong>Estado:</strong> {{ $book->estado }}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('book.show', ['id' => $book->id]) }}" class="btn btn-success">Ver Datos</a>
                                <a href="{{ route('book.editar', ['id' => $book->id]) }}" class="btn btn-primary">Editar</a>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $book->id }}">
                                    Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @foreach ($books as $book)
            <div class="modal fade" id="modal-{{ $book->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Eliminar este Dato</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿QUIERE ELIMINAR PERMANENTEMENTE ESTE DATO?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <form method="post" action="{{ route('book.borrar', [$book->id]) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
