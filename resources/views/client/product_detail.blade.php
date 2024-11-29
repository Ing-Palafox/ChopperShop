@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row align-items-center">
        <!-- Imagen del producto -->
        <div class="col-md-6">
            @if($producto->imagen)
                <img src="{{ Storage::url($producto->imagen) }}" class="img-fluid rounded" alt="{{ $producto->nombre }}">
            @else
                <img src="https://via.placeholder.com/300" class="img-fluid rounded" alt="Imagen no disponible">
            @endif
        </div>

        <!-- Detalles del producto -->
        <div class="col-md-6">
            <h1 class="text-white" style="font-size: 2.5rem;">{{ $producto->nombre }}</h1>
            <h2 class="text-success" style="font-size: 2rem;">${{ number_format($producto->precio, 2) }}</h2>
            <p class="text-white" style="font-size: 1.2rem;">{{ $producto->descripcion }}</p>
            <p class="text-white" style="font-size: 1.2rem;"><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
            
            <a href="#" class="btn btn-success btn-lg mt-3">Añadir al carrito</a>
        </div>
    </div>
</div>
@endsection
