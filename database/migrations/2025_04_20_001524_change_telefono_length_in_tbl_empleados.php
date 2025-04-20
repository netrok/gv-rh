<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTelefonoLengthInTblEmpleados extends Migration
{
    public function up()
    {
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->string('telefono', 20)->change();  // Aumenta el tamaño del campo
        });
    }

    public function down()
    {
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->string('telefono', 15)->change();  // Vuelve a 15 si es necesario
        });
    }
}