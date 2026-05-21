<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reparaciones_piezas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_reparacion');
            $table->unsignedBigInteger('id_pieza');
            $table->integer('cantidad_usada');
            $table->unsignedBigInteger('id_usuario');
            $table->timestamps();

            $table->foreign('id_reparacion')
                  ->references('id_reparacion')
                  ->on('reparaciones')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('id_pieza')
                  ->references('id_pieza')
                  ->on('piezas')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reparaciones_piezas');
    }
};
