<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    // Asegúrate de definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'categoria_id',
        'imagen', // Agregar el campo imagen
        'es_preventa',
        'fecha_lanzamiento',
        'stock_preventa',
    ];

    // Usar el atributo $casts para convertir 'fecha_lanzamiento' en un objeto Carbon automáticamente
    protected $casts = [
        'fecha_lanzamiento' => 'datetime',  // Esto asegura que 'fecha_lanzamiento' sea tratado como una instancia de Carbon
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
