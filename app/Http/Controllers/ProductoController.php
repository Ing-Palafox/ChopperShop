<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class ProductoController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         //
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         //
//     }
// }













namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    // Mostrar el formulario para crear un nuevo producto
    public function create()
    {
        $categorias = Categoria::all();  // Obtener todas las categorías
        return view('productos.create', compact('categorias'));
    }

    // Guardar el nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:150',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar el formulario para editar un producto
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();  // Obtener todas las categorías
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // Actualizar el producto
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|max:150',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    // Eliminar un producto
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
}
