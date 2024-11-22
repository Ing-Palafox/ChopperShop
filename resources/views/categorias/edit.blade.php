@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Categoría</h1>
    
    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Actualizar</button>
    </form>
</div>
@endsection
