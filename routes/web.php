<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoClienteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    // Rutas para categorías y productos
    Route::resource('categorias', CategoriaController::class);
    Route::resource('productos', ProductoController::class);
    //Ruta para crear producto
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    // Rutas para el cliente
    Route::get('/', [ProductoClienteController::class, 'index'])->name('cliente.home');
    //Ruta para los detalles de productos para cliente
    Route::get('/productos/{producto}', [ProductoClienteController::class, 'show'])->name('cliente.productos.show');
    //ruta para el catalogo
    Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('catalogo');
    //Detalles de producto cliente en catalogo
    Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('product.detail');





});

require __DIR__.'/auth.php';
