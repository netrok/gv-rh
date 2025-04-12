<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTables extends Migration
{
    public function up()
    {
        // Agregar la relación entre 'tbl_empleados' y 'tbl_puestos'
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->foreign('fk_id_puesto')->references('id_puesto')->on('tbl_puestos')->onDelete('cascade');
        });

        // Agregar la relación entre 'tbl_empleados' y 'tbl_sucursales'
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->foreign('fk_id_sucursal')->references('id_sucursal')->on('tbl_sucursales')->onDelete('cascade');
        });

        // Agregar la relación entre 'tbl_beneficiarios' y 'tbl_empleados'
        Schema::table('tbl_beneficiarios', function (Blueprint $table) {
            $table->foreign('fk_num_empleado')->references('num_empleado')->on('tbl_empleados')->onDelete('cascade');
        });

        // Agregar la relación entre 'tbl_solicitudes_vacaciones' y 'tbl_empleados'
        Schema::table('tbl_solicitudes_vacaciones', function (Blueprint $table) {
            $table->foreign('fk_num_empleado')->references('num_empleado')->on('tbl_empleados')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Eliminar las relaciones en el método down
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->dropForeign(['fk_id_puesto']);
            $table->dropForeign(['fk_id_sucursal']);
        });

        Schema::table('tbl_beneficiarios', function (Blueprint $table) {
            $table->dropForeign(['fk_num_empleado']);
        });

        Schema::table('tbl_solicitudes_vacaciones', function (Blueprint $table) {
            $table->dropForeign(['fk_num_empleado']);
        });
    }
}
