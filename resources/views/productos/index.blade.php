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
                <td>{{ $producto->precio }}</td>
                <td>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
