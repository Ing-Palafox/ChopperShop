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
        Schema::table('productos', function (Blueprint $table) {
            $table->boolean('es_preventa')->default(false); // Indica si es preventa
            $table->date('fecha_lanzamiento')->nullable(); // Fecha de lanzamiento
            $table->integer('stock_preventa')->nullable(); // Stock para la preventa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn(['es_preventa', 'fecha_lanzamiento', 'stock_preventa']);
        });
    }
};
