<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('referencia');
            $table->string('producto');
            $table->decimal('precio_unidad', 8, 2);
            $table->decimal('precio_venta', 8, 2);
            $table->date('fecha_compra');
            $table->date('fecha_vencimiento')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}

