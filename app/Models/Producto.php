<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // o el nombre de tu tabla
    protected $fillable = [
        'referencia',
        'producto',
        'precio_unidad',
        'precio_venta',
        'fecha_compra',
        'fecha_vencimiento',
    ];
}
