<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saldo_taller', function (Blueprint $table) {
            $table->unsignedInteger('id')->default(1)->primary();
            $table->decimal('saldo', 12, 2)->default(0.00);
            $table->timestamp('ultima_actualizacion')->nullable()->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saldo_taller');
    }
};
