@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 1000px; margin-top: 20px;">
        <div class="card shadow">
            <div class="card-header bg-primary text-white ">
                <center><h4 class="mb-0">PERFIL DE USUARIO</h4></center>
            </div>
            <div class="card-body ">
             
                <div class="mb-3">
                    <h6><b>Nombre:</b></h6>
                    <p>{{ $user->name }}</p>
                </div>
                <div class="mb-3">
                    <h6><b>Correo Electrónico:</b></h6>
                    <p>{{ $user->email }}</p>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Dejar un Comentario</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('rating.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="calificador_id" value="{{ auth()->id() }}">

                            <div class="mb-3">
                                <label for="puntuacion" class="form-label"><b>Puntuación:</b></label>
                                <select name="puntuacion" id="puntuacion" class="form-select" required>
                                    <option value="" disabled selected>Seleccionar</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="comentario" class="form-label"><b>Comentario:</b></label>
                                <textarea name="comentario" id="comentario" class="form-control" rows="3" maxlength="255" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Enviar</button>
                        </form>
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
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('book.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
