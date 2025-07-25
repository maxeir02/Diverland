<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('proveedors', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('direccion');
        $table->string('correo');
        $table->string('contacto');
        $table->text('datos_facturacion')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
