<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario'); // Auto-increment y Primary Key
            $table->string('nombre', 100);
            $table->string('email', 100)->unique();
            $table->string('dni', 20)->unique();
            $table->string('telefono', 15); // Añadido campo teléfono
            $table->string('contraseña', 255);
            $table->enum('rol', ['mecanico', 'admin', 'cliente']);
            $table->timestamps(); // Recomendado en Laravel
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
