@extends('layouts.app')

@section('content')

    <div class="container" style="max-width: 600px; margin-top: 20px;">
        <form method="POST" action="{{ route('book.update', [$books->id]) }}" class="needs-validation">
            @method('PUT')
            @csrf

            <div class="card shadow">
                <h4 class="card-header bg-primary text-white text-center">
                    <b>EDITAR DATOS DEL LIBRO</b>
                </h4>
                <div class="card-body">

                    <div class="mb-3">
                        <label for="titulo" class="form-label"><b>TITULO:</b></label>
                        <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                               name="titulo" id="titulo" placeholder="Ingrese el Nuevo Titulo" 
                               value="{{ old('titulo') ?? $books->titulo }}">
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="autor" class="form-label"><b>AUTOR:</b></label>
                        <input type="text" class="form-control @error('autor') is-invalid @enderror" 
                               name="autor" id="autor" placeholder="Ingrese el Nuevo Autor" 
                               value="{{ old('autor') ?? $books->autor }}">
                        @error('autor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label"><b>DESCRIPCION:</b></label>
                        <input type="text" class="form-control @error('descripcion') is-invalid @enderror" 
                               name="descripcion" id="descripcion" placeholder="Ingrese Nueva la Descripcion" 
                               value="{{ old('descripcion') ?? $books->descripcion }}">
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label"><b>PRECIO:</b></label>
                        <input type="number" class="form-control @error('precio') is-invalid @enderror" 
                               name="precio" id="precio" placeholder="Ingrese el Nuevo Precio" 
                               value="{{ old('precio') ?? $books->precio }}">
                        @error('precio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="estado" class="form-label"><b>ESTADO:</b></label>
                        <select class="form-control @error('estado') is-invalid @enderror" name="estado" id="estado">
                            <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>
                                Disponible
                            </option>
                            <option value="vendido" {{ old('estado') == 'vendido' ? 'selected' : '' }}>
                                Vendido
                            </option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary me-2">Editar</button>
                        <a href="{{ route('book.index') }}" class="btn btn-secondary">Volver</a>
                    </div>

                </div>
            </div>
        </form>
    </div>

@endsection
