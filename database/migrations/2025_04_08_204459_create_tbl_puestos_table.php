<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPuestosTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_puestos', function (Blueprint $table) {
            $table->id('id_puesto');  // ID del puesto
            $table->string('nombre_puesto', 100);  // Nombre del puesto
            $table->decimal('sueldo_base', 10, 2);  // Sueldo base con dos decimales
            $table->string('jefe_directo', 200);  // Nombre del jefe directo
            $table->string('status_puesto', 20)->default('activo');  // Estado del puesto con valor predeterminado 'activo'
            $table->timestamps();  // Tiempos de creación y actualización
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_puestos');  // Elimina la tabla si ya existe
    }
}
