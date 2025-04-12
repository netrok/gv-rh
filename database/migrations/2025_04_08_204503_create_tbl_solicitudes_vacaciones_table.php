<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSolicitudesVacacionesTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_solicitudes_vacaciones', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('fk_num_empleado');
            $table->integer('anio');
            $table->integer('dias_otorgados');
            $table->integer('dias_disfrutados');
            $table->integer('saldo');
            $table->text('observaciones');
            $table->string('estado_solicitud', 10);
            $table->date('fecha_solicitud');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_solicitudes_vacaciones');
    }
}
