@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Producto</h1>

    <!-- <style> .form-group label, .form-control, .btn { color: white; } </style> -->
    
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group">
             <label for="descripcion">Descripción</label>
             <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-control" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Imagen -->
        <div class="mb-3">
             <label for="imagen" class="form-label">Imagen</label>
             <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Guardar</button>
    </form>
</div>
@endsection
