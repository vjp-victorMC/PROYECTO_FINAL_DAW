<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('piezas', function (Blueprint $table) {
            $table->id('id_pieza');
            $table->string('nombre_pieza', 100);
            $table->integer('cantidad_disponible')->default(0);
            $table->decimal('precio_compra', 10, 2);
            $table->decimal('precio_venta', 10, 2);
            $table->integer('stock_minimo')->default(5);
            $table->unsignedBigInteger('id_proveedor')->nullable();
            $table->timestamps();

            $table->foreign('id_proveedor')
                  ->references('id_proveedor')
                  ->on('proveedores')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('piezas');
    }
};
