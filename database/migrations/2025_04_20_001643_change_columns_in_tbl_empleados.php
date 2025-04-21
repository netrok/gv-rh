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
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->string('num_empleado', 30)->change(); // Cambia el tamaño a 30 si es necesario
            $table->string('telefono', 20)->change(); // Cambia el tamaño a 20 si es necesario
            $table->string('celular', 20)->change(); // Cambia el tamaño a 20 si es necesario
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->string('num_empleado', 15)->change();
            $table->string('telefono', 15)->change();
            $table->string('celular', 15)->change();
        });
    }
};