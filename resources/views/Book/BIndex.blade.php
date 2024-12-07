@extends('layouts.app')

@section('content')

    <h1>
        <center><b>Catalogo de Libros</b></center>
    </h1>

    <div class="container">
        <div class="row" ALIGN="center">
            <div class="col-xl-12" ALIGN="center">
                <form action="{{ route('book.index') }}" method="get">
                    <div class="form-row">
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="buscar" placeholder ="Buscar"
                                value="{{ $BookBuscar }}">
                        </div>
                        <div class="col-auto">
                            <br>
                            <input type="submit" class="btn btn-primary" value="Buscar">
                            <a class="btn btn-success" href="{{ route('book.index') }}">Volver</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-12">
            </div>
        </div>
    </div>
    <br>

    <div class="container">
        <div class="row">
            @forelse($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card border-dark">
                        <div class="card-header bg-dark text-white">
                            <center><strong>Título: {{ $book->titulo }}</strong></center>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><strong>Autor:</strong> {{ $book->autor }}</p>
                            <p class="card-text"><strong>Descripción:</strong> {{ $book->descripcion }}</p>
                            <p class="card-text"><strong>Precio:</strong> Lps.{{ $book->precio }}</p>
                            <p class="card-text"><strong>Estado:</strong> {{ $book->estado }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <a href="{{ route('book.show', ['id' => $book->id]) }}" class="btn btn-success" style="width: 200px;">Ver Datos</a>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center" role="alert">
                        NO HAY LIBROS
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <br>

    <div class="custom-center">
        {{ $books->render('pagination::bootstrap-4') }}
    </div>
@endsection
