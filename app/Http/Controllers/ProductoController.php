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
// use Storage;
use Illuminate\Support\Facades\Storage;

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
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validación para imagen
        ]);
            
            // Subir la imagen
    $imagenPath = null;
    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('productos', 'public');
    } else {
        $imagenPath = null; // Si no se sube una imagen, asignamos null
    }

    // Crear el producto con la imagen
    Producto::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'cantidad' => $request->cantidad,
        'categoria_id' => $request->categoria_id,
        'imagen' => $imagenPath,  // Guardar la ruta de la imagen
    ]);

        // Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
        return redirect()->back()->with('error', 'No se pudo crear el producto. Inténtalo nuevamente.');

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
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Verificar si hay una nueva imagen
    if ($request->hasFile('imagen')) {
        // Eliminar la imagen anterior si existe
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        // Guardar la nueva imagen
        $imagenPath = $request->file('imagen')->store('productos', 'public');
        $producto->imagen = $imagenPath;
    }

    // Actualizar los datos restantes
    $producto->update([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'cantidad' => $request->cantidad,
        'categoria_id' => $request->categoria_id,
    ]);

    // Guardar los cambios en la imagen, si se subió
    $producto->save();

    return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
}

    // Eliminar un producto
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
}
