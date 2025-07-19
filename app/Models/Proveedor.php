<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = [
        'nombre', 'direccion', 'correo', 'contacto', 'datos_facturacion'
    ];
}
