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
        //Schema::table('asistencias', function (Blueprint $table) {
         //   $table->bigInteger('num_empleado')->change(); // Cambiar el tipo de columna a bigint
       // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asistencias', function (Blueprint $table) {
            $table->string('num_empleado')->change(); // Regresar el tipo de columna a string
        });
    }
};