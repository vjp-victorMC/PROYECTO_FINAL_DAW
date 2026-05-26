<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id('id_mensaje'); // Auto-increment y Primary Key

            // Claves foráneas
            $table->unsignedBigInteger('usuario_envio');
            $table->unsignedBigInteger('usuario_recibo');

            // Campos de contenido
            $table->string('matricula', 15); 
            $table->string('asunto', 150);
            $table->text('mensaje');
            $table->timestamps();

            // Relaciones
            $table->foreign('usuario_envio')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('usuario_recibo')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
