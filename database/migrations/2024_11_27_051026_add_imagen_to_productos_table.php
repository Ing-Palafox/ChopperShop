<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->string('imagen')->nullable(); // Agrega el campo imagen como string (ruta o nombre del archivo)
        });
    }
    
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('imagen'); // Elimina el campo imagen en caso de rollback
        });
    }
};
