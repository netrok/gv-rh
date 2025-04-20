<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNumEmpleadoTypeInTblEmpleados extends Migration
{
    public function up()
    {
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->string('num_empleado', 20)->change();  // Cambiar tipo a string
        });
    }

    public function down()
    {
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->integer('num_empleado')->change();  // Volver a integer si es necesario
        });
    }
}