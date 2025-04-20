<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsInTblEmpleados extends Migration
{
    public function up()
    {
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->string('num_empleado', 20)->change();
            $table->string('telefono', 20)->change();
            $table->string('celular', 20)->change();
        });
    }

    public function down()
    {
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->string('num_empleado', 15)->change();
            $table->string('telefono', 15)->change();
            $table->string('celular', 15)->change();
        });
    }
}