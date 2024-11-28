@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Categoría</h1>

    <style> .form-group label, .form-control, .btn { color: white; }
    </style>
    
    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Guardar</button>
    </form>
</div>
@endsection
