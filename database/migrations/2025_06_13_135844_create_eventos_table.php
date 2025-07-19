<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id(); // o código_evento si prefieres personalizado
            $table->string('codigo_punto');
            $table->string('usuario_trabajador');
            $table->string('codigo_juego')->nullable();
            $table->string('codigo_insumo')->nullable();
            $table->dateTime('horario');
            $table->string('lugar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
