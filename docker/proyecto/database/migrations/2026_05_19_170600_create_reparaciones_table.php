<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reparaciones', function (Blueprint $table) {
            $table->id('id_reparacion');
            $table->unsignedBigInteger('id_coche');
            $table->unsignedBigInteger('id_mecanico')->nullable();
            $table->string('motivo', 255);
            $table->decimal('horas_trabajo', 5, 2);
            $table->decimal('coste_mano_obra', 10, 2);
            $table->decimal('coste_total_piezas', 10, 2);
            $table->decimal('coste_total_reparacion', 10, 2);
            $table->dateTime('fecha_entrada')->useCurrent();
            $table->dateTime('fecha_salida')->nullable();
            $table->enum('estado', ['pendiente', 'en proceso', 'finalizada'])->default('pendiente');
            $table->timestamps();

            $table->foreign('id_coche')
                  ->references('id_coche')
                  ->on('coches')
                  ->onDelete('cascade');

            $table->foreign('id_mecanico')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reparaciones');
    }
};
