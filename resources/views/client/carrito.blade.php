@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-white">Carrito de compras</h2>

    @if(Session::has('carrito') && count(Session::get('carrito')) > 0)
        <table class="table table-striped table-bordered text-white">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($carrito as $item)
    @if(isset($item['producto']))
        <tr>
            <td><img src="{{ Storage::url($item['producto']->imagen) }}" class="img-fluid" style="width: 100px;"></td>
            <td>{{ $item['producto']->nombre }}</td>
            <td>{{ $item['cantidad'] }}</td>
            <td>${{ number_format($item['producto']->precio, 2) }}</td>
            <td>${{ number_format($item['producto']->precio * $item['cantidad'], 2) }}</td>
            <td>
                <form action="{{ route('carrito.eliminar', $item['producto']->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
    @else
        <tr>
            <td colspan="6">El producto no está disponible.</td>
        </tr>
    @endif
@endforeach

            </tbody>
        </table>

        <!-- Total -->
        <div class="d-flex justify-content-between">
            <h3 class="text-white">Total: ${{ number_format(array_sum(array_map(function($item) { return $item['producto']->precio * $item['cantidad']; }, $carrito)), 2) }}</h3>
        </div>
    @else
        <p class="text-white">Tu carrito está vacío.</p>
    @endif
</div>
@endsection
