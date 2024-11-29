<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    //
    // Mostrar el carrito
    public function index()
    {
        $carrito = Session::get('carrito', []);
        return view('client.carrito', compact('carrito'));
    }

    // Agregar un producto al carrito
    public function agregar(Producto $producto)
    {
        $carrito = Session::get('carrito', []);
        
        // Si el producto ya está en el carrito, incrementamos la cantidad
        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad']++;
        } else {
            // Si no está, lo agregamos con cantidad 1
            $carrito[$producto->id] = [
                'producto' => $producto,
                'cantidad' => 1
            ];
        }

        // Guardar el carrito en la sesión
        Session::put('carrito', $carrito);
        return redirect()->route('carrito.index')->with('success', 'Producto añadido al carrito.');
    }

    // Eliminar un producto del carrito
    public function eliminar(Producto $producto)
    {
        $carrito = Session::get('carrito', []);

        // Eliminar el producto del carrito
        if (isset($carrito[$producto->id])) {
            unset($carrito[$producto->id]);
        }

        // Guardar los cambios en la sesión
        Session::put('carrito', $carrito);
        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }
}
