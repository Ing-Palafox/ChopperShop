@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Productos Disponibles</h1>

    <div class="row">
        @foreach($productos as $producto)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                @if($producto->imagen)
                <img src="{{ Storage::url($producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                @else
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Imagen no disponible">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($producto->descripcion, 50, '...') }}</p>
                    <p class="card-text"><strong>${{ number_format($producto->precio, 2) }}</strong></p>
                    <a href="{{ route('cliente.productos.show', $producto->id) }}" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- <div class="d-flex justify-content-center mt-4">
        {{ $productos->links() }}  Paginación -->
    <!--</div> -->

     <!-- Paginación personalizada -->
     <div class="d-flex justify-content-center">
        {{ $productos->links('pagination::bootstrap-4') }} <!-- Aquí usas el layout de paginación de Bootstrap -->
    </div>
</div>
@endsection