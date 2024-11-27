<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'nombre', // Si este es el único campo que deseas guardar
        'descripcion', // Agrega cualquier otro campo necesario
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
