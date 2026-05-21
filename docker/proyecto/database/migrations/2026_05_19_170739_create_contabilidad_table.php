<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contabilidad', function (Blueprint $table) {
            $table->id('id_transaccion');
            $table->enum('tipo', ['ingreso', 'gasto']);
            $table->decimal('cantidad', 10, 2);
            $table->dateTime('fecha')->useCurrent();
            $table->string('concepto', 255);
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contabilidad');
    }
};
