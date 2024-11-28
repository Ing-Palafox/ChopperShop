@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Productos</h1>
    <a href="{{ route('productos.create') }}" class="btn btn-primary">Agregar Producto</a>
    
    <style> .table th, .table td { color: white; }
    </style>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>IMG</th>
                <th>#</th>
                <th>Nombre</th>
                <th>Descripción</th> <!-- Nueva columna -->
                <th>Categoría</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>
                    @if($producto->imagen)
                        <img src="{{ Storage::url($producto->imagen) }}" alt="{{ $producto->nombre }}" width="100">
                     @else
                         <span>No disponible</span>
                    @endif
                </td>

                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion ?? 'Sin descripción' }}</td> <!-- Mostrar descripción -->
                <td>{{ $producto->categoria->nombre }}</td>
                <td>${{ number_format($producto->precio, 2) }}</td>
                <td>
                    <!-- Botón "Ver Producto" -->
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalProducto{{ $producto->id }}">
                        Ver Producto
                    </button>
                    
                    <!-- Botón "Editar" -->
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Editar</a>

                    <!-- Formulario para "Eliminar" -->
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete">Eliminar</button>
                    </form>
                </td>
            </tr>

            <!-- Modal para Ver Producto -->
            <div class="modal fade" id="modalProducto{{ $producto->id }}" tabindex="-1" aria-labelledby="modalProductoLabel{{ $producto->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalProductoLabel{{ $producto->id }}">Detalles del Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Mostrar imagen del producto -->
                                    @if($producto->imagen)
                                        <img src="{{ Storage::url($producto->imagen) }}" class="img-fluid rounded" alt="{{ $producto->nombre }}">
                                    @else
                                        <img src="https://via.placeholder.com/300" class="img-fluid rounded" alt="Sin imagen disponible">
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <!-- Mostrar detalles del producto -->
                                    <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                                    <p><strong>Descripción:</strong> {{ $producto->descripcion ?? 'Sin descripción' }}</p>
                                    <p><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
                                    <p><strong>Cantidad:</strong> {{ $producto->cantidad }}</p>
                                    <p><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
