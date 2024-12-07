<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoClienteController extends Controller
{
    // Mostrar productos y preventas para el cliente
    public function index()
    {
        // Recuperar los productos normales
        $productos = Producto::where('es_preventa', false)->paginate(12);

        // Recuperar las preventas
        $preventas = Producto::where('es_preventa', true)->paginate(12);

        return view('client.home', compact('productos', 'preventas'));
    }

    public function show(Producto $producto)
    {
        return view('client.product_detail', compact('producto'));
    }
}
