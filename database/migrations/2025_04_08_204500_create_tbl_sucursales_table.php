<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSucursalesTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_sucursales', function (Blueprint $table) {
            $table->id('id_sucursal');
            $table->string('nombre_sucursal', 150);
            $table->text('direccion');
            $table->string('telefono_1', 10);
            $table->string('telefono_2', 10);
            $table->string('celular', 10);
            $table->string('responsable', 255);
            $table->string('email_responsable', 255);
            $table->string('status_suursal', 10);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_sucursales');
    }
}
