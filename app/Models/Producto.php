<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'categoria_id',
        'imagen', // Agregar el campo imagen
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
