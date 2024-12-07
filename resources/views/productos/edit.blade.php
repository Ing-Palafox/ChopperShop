@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>

    

    <!-- Mostrar mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Usamos PUT para actualizar el producto -->
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" required>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad', $producto->cantidad) }}" required>
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <select class="form-select" id="categoria_id" name="categoria_id" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
             <label for="es_preventa">¿Es preventa?</label>
             <input type="checkbox" name="es_preventa" id="es_preventa" value="1" {{ $producto->es_preventa ? 'checked' : '' }}>
        </div>

        <div class="form-group">
            <label for="fecha_lanzamiento">Fecha de lanzamiento</label>
            <input type="date" name="fecha_lanzamiento" id="fecha_lanzamiento" class="form-control" value="{{ $producto->fecha_lanzamiento }}">
        </div>

        <div class="form-group">
            <label for="stock_preventa">Stock para preventa</label>
            <input type="number" name="stock_preventa" id="stock_preventa" class="form-control" value="{{ $producto->stock_preventa }}">
        </div>

        <div class="mb-3">
            <label for="imagen_actual" class="form-label">Imagen Actual</label>
            <br>
            @if($producto->imagen)
                <img src="{{ Storage::url($producto->imagen) }}" alt="Imagen actual" class="img-thumbnail" width="150">
            @else
                <p>No hay imagen disponible</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Nueva Imagen (opcional)</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
        </div>


        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
    </form>
</div>
@endsection
