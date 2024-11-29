<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoClienteController extends Controller
{
    //Mostrar productos para el cliente
    public function index()
    {
        $productos = Producto::paginate(12); // Paginación de 12 productos por página
        return view('client.home', compact('productos'));
    }

    public function show(Producto $producto)
    {
        return view('client.product_detail', compact('producto'));
    }


}
