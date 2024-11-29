@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-white">Catálogo de Productos</h1>

    <!-- Filtros -->
    <form method="GET" action="{{ route('catalogo') }}" class="mb-4">
        <div class="row align-items-end">
            <!-- Filtro por categoría -->
            <div class="col-md-4">
                <label for="categoria" class="form-label text-white">Categoría</label>
                <select name="categoria" id="categoria" class="form-select">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Rango de precios -->
            <div class="col-md-3">
                <label for="min_price" class="form-label text-white">Precio mínimo</label>
                <input type="number" name="min_price" id="min_price" class="form-control" placeholder="0" value="{{ request('min_price') }}">
            </div>
            <div class="col-md-3">
                <label for="max_price" class="form-label text-white">Precio máximo</label>
                <input type="number" name="max_price" id="max_price" class="form-control" placeholder="0" value="{{ request('max_price') }}">
            </div>
            <!-- Botón filtrar -->
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Productos -->
    <div class="row">
        @foreach($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ $producto->imagen ? Storage::url($producto->imagen) : 'https://via.placeholder.com/300' }}" class="card-img-top" alt="{{ $producto->nombre }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text text-muted">${{ number_format($producto->precio, 2) }}</p>
                        <a href="{{ route('product.detail', $producto->id) }}" class="btn btn-primary btn-sm">Ver detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $productos->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
