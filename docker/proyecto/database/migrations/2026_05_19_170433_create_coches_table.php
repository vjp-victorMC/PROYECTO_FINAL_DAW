<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coches', function (Blueprint $table) {
            $table->id('id_coche');
            $table->string('matricula', 20)->unique();
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->unsignedBigInteger('id_cliente');
            $table->string('imagen', 255)->nullable();
            $table->boolean('en_garaje')->default(false);
            $table->timestamps();

            $table->foreign('id_cliente')
                  ->references('id_cliente')
                  ->on('clientes')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coches');
    }
};
