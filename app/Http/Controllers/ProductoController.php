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
    public function index(Request $request)
{
    $query = Producto::query();

    if ($request->has('search')) {
         // Filtrar productos por nombre si hay una búsqueda
        $query->where('nombre', 'like', '%' . $request->search . '%');
    }

    //$productos = $query->get();
    // Paginación de productos, 10 por página
    $productos = $query->paginate(10);
    return view('productos.index', compact('productos'));
}

    // Mostrar el formulario para crear un nuevo producto
    public function create()
    {
        $categorias = Categoria::all();  // Obtener todas las categorías
        return view('productos.create', compact('categorias'));
    }

    // Guardar el nuevo producto
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nombre' => 'required|max:150',
    //         'descripcion' => 'nullable',
    //         'precio' => 'required|numeric',
    //         'cantidad' => 'required|integer',
    //         'categoria_id' => 'required|exists:categorias,id',
    //         'imagen' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validación para imagen
    //     ]);
            
    //         // Subir la imagen
    // $imagenPath = null;
    // if ($request->hasFile('imagen')) {
    //     $imagenPath = $request->file('imagen')->store('productos', 'public');
    // } else {
    //     $imagenPath = null; // Si no se sube una imagen, asignamos null
    // }

    // // Crear el producto con la imagen
    // Producto::create([
    //     'nombre' => $request->nombre,
    //     'descripcion' => $request->descripcion,
    //     'precio' => $request->precio,
    //     'cantidad' => $request->cantidad,
    //     'categoria_id' => $request->categoria_id,
    //     'imagen' => $imagenPath,  // Guardar la ruta de la imagen
    // ]);

    //     // Producto::create($request->all());
    //     return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    //     return redirect()->back()->with('error', 'No se pudo crear el producto. Inténtalo nuevamente.');

    // }


    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|max:150',
        'descripcion' => 'nullable',
        'precio' => 'required|numeric',
        'cantidad' => 'required|integer',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', 
        'es_preventa' => 'nullable|boolean',
        'fecha_lanzamiento' => 'nullable|date|after:today',
        'stock_preventa' => 'nullable|integer|min:0',
    ]);

    $imagenPath = null;
    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('productos', 'public');
    }

    Producto::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'cantidad' => $request->cantidad,
        'categoria_id' => $request->categoria_id,
        'imagen' => $imagenPath,
        'es_preventa' => $request->es_preventa ?? false,
        'fecha_lanzamiento' => $request->fecha_lanzamiento,
        'stock_preventa' => $request->stock_preventa,
    ]);

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
//     public function update(Request $request, Producto $producto)
// {
//     $request->validate([
//         'nombre' => 'required|max:150',
//         'descripcion' => 'nullable',
//         'precio' => 'required|numeric',
//         'cantidad' => 'required|integer',
//         'categoria_id' => 'required|exists:categorias,id',
//         'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//     ]);

//     // Verificar si hay una nueva imagen
//     if ($request->hasFile('imagen')) {
//         // Eliminar la imagen anterior si existe
//         if ($producto->imagen) {
//             Storage::disk('public')->delete($producto->imagen);
//         }

//         // Guardar la nueva imagen
//         $imagenPath = $request->file('imagen')->store('productos', 'public');
//         $producto->imagen = $imagenPath;
//     }

//     // Actualizar los datos restantes
//     $producto->update([
//         'nombre' => $request->nombre,
//         'descripcion' => $request->descripcion,
//         'precio' => $request->precio,
//         'cantidad' => $request->cantidad,
//         'categoria_id' => $request->categoria_id,
//     ]);

//     // Guardar los cambios en la imagen, si se subió
//     $producto->save();

//     return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
// }



public function update(Request $request, Producto $producto)
{
    $request->validate([
        'nombre' => 'required|max:150',
        'descripcion' => 'nullable',
        'precio' => 'required|numeric',
        'cantidad' => 'required|integer',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'es_preventa' => 'nullable|boolean',
        'fecha_lanzamiento' => 'nullable|date|after:today',
        'stock_preventa' => 'nullable|integer|min:0',
    ]);

    if ($request->hasFile('imagen')) {
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->imagen = $request->file('imagen')->store('productos', 'public');
    }

    $producto->update([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'cantidad' => $request->cantidad,
        'categoria_id' => $request->categoria_id,
        'es_preventa' => $request->es_preventa ?? false,
        'fecha_lanzamiento' => $request->fecha_lanzamiento,
        'stock_preventa' => $request->stock_preventa,
    ]);

     // Guardar los cambios en la imagen, si se subió
     $producto->save();


    return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
}





    // Eliminar un producto
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }

    public function catalogo(Request $request)
    {
    $query = Producto::query();

    // Filtro por categoría
    if ($request->has('categoria')) {
        $query->where('categoria_id', $request->categoria);
    }

    // Filtro por rango de precio
    if ($request->has('min_price') && $request->has('max_price')) {
        $query->whereBetween('precio', [$request->min_price, $request->max_price]);
    }

    $productos = $query->paginate(12);
    $categorias = Categoria::all(); // Obtener las categorías para los filtros

    return view('client.catalogo', compact('productos', 'categorias'));
    }

    public function show($id)
    {
        // Buscar el producto por ID o lanzar un error 404 si no se encuentra
        $producto = Producto::findOrFail($id);
    
        // Retornar la vista de detalles del producto
        return view('client.product_detail', compact('producto'));
    }

    //agregar al carrito
    public function agregarAlCarrito(Request $request)
    {
    $productoId = $request->input('producto_id');
    $cantidad = $request->input('cantidad', 1); // Por defecto, 1 unidad

    // Obtener producto por ID
    $producto = Producto::findOrFail($productoId);

    // Crear la estructura del carrito en la sesión
    $carrito = session()->get('carrito', []);

    // Si el producto ya está en el carrito, actualizamos la cantidad
    if (isset($carrito[$productoId])) {
        $carrito[$productoId]['cantidad'] += $cantidad;
    } else {
        // Si no está, lo añadimos con los detalles
        $carrito[$productoId] = [
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'cantidad' => $cantidad,
            'imagen' => $producto->imagen,
        ];
    }

    // Guardar el carrito en la sesión
    session()->put('carrito', $carrito);

    return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }

    //listar preventas
    // public function listarPreventas()
    // {
    // $preventas = Producto::where('es_preventa', true)->paginate(10);

    // return view('preventas.index', compact('preventas'));
    // }

    public function listarPreventas(Request $request)
{
    $query = Producto::where('es_preventa', true);

    if ($request->has('categoria_id')) {
        $query->where('categoria_id', $request->categoria_id);
    }

    if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
        $query->whereBetween('fecha_lanzamiento', [$request->fecha_inicio, $request->fecha_fin]);
    }

    $preventas = $query->paginate(10);

    $categorias = Categoria::all();
    return view('preventas.index', compact('preventas', 'categorias'));
}


}
