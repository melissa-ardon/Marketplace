@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 1000px; margin-top: 20px;">
        <div class="card shadow">
            <h4 class="card-header text-center bg-primary text-white">
                <b>DATOS DEL LIBRO</b>
            </h4>
            <div class="card-body">
                <div class="mb-3">
                    <h5><b>TÍTULO:</b></h5>
                    <p>{{ $book->titulo }}</p>
                </div>
                <div class="mb-3">
                    <h5><b>AUTOR:</b></h5>
                    <p>{{ $book->autor }}</p>
                </div>
                <div class="mb-3">
                    <h5><b>DESCRIPCIÓN:</b></h5>
                    <p>{{ $book->descripcion }}</p>
                </div>
                <div class="mb-3">
                    <h5><b>PRECIO:</b></h5>
                    <p>{{ $book->precio }}</p>
                </div>
                <div class="mb-3">
                    <h5><b>DUEÑO:</b></h5>
                    <p>
                        <a href="{{ route('user.show', ['id' => $book->user->id]) }}" class="text-decoration-none">
                            {{ $book->user->name ?? 'Desconocido' }}
                        </a>
                    </p>
                </div>

                <form action="{{ route('message.store', $book->user->id) }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <div class="form-group mb-3">
                        <textarea name="contenido" class="form-control" rows="4" required placeholder="Escribe tu mensaje aquí..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar mensaje</button>
                </form>

                <h5><b>MENSAJES:</b></h5>
                @if ($book->messages->isEmpty())
                    <p class="text-muted">No hay mensajes asociados a este libro.</p>
                @else
                    <ul class="list-group">
                        @foreach ($book->messages as $message)
                            <li class="list-group-item">
                                <b>De:</b> {{ $message->sender->name }} <br>
                                <b>Mensaje:</b> {{ $message->contenido }} <br>
                                <small class="text-muted">Enviado el {{ $message->created_at->format('d-m-Y H:i') }}</small>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('book.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
