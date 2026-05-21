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
        Schema::create('vehiculo2mano', function (Blueprint $table) {
            $table->id();
            $table->string('matricula', 20)->unique();
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->string('imagen', 255)->nullable();
            $table->decimal('precio', 10, 2); // Hasta 99.999.999,99
            $table->text('especificaciones')->nullable(); // Para descripciones largas
            $table->integer('km');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculo2mano');
    }
};
