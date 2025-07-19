<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

   // App\Models\Cliente.php
protected $fillable = ['nombre', 'edad', 'tiempo_pago', 'hora_entrada', 'metodo_pago'];

}
