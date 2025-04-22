<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblVacacionesTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_vacaciones', function (Blueprint $table) {
            $table->id('id');
            $table->string('fk_num_empleado');
            $table->integer('anio');
            $table->integer('dias_otorgados');
            $table->integer('dias_disfrutados');
            $table->integer('saldo');
            $table->text('observaciones')->nullable(); // Hacemos que observaciones sea opcional
            $table->string('estado_solicitud', 10);
            $table->date('fecha_solicitud');
            $table->timestamps();

            // Definir la relación de clave foránea
            $table->foreign('fk_num_empleado')->references('num_empleado')->on('tbl_empleados')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_vacaciones');
    }
}
