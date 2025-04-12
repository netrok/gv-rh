<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPuestosTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_puestos', function (Blueprint $table) {
            $table->id('id_puesto');
            $table->string('nombre_puesto', 100);
            $table->decimal('sueldo_base', 10, 2);
            $table->string('jefe_directo', 200);
            $table->string('status_puesto', 10);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_puestos');
    }
}
