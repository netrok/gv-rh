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
        // Cambiar tipo de las columnas para permitir más caracteres
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->string('num_empleado', 30)->change();
            $table->string('telefono', 20)->change();
            $table->string('celular', 20)->change();
        });

        // Actualizar fk_num_empleado en tbl_beneficiarios
        Schema::table('tbl_beneficiarios', function (Blueprint $table) {
            $table->bigInteger('fk_num_empleado')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Volver a cambiar las columnas a su tamaño original
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->string('num_empleado', 15)->change();
            $table->string('telefono', 15)->change();
            $table->string('celular', 15)->change();
        });

        // Revertir el cambio en fk_num_empleado
        Schema::table('tbl_beneficiarios', function (Blueprint $table) {
            $table->string('fk_num_empleado')->change();
        });
    }
};