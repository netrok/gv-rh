<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_empleados', function (Blueprint $table) {
            $table->id('id_empleado');
            $table->integer('num_empleado')->unique();
            $table->string('nombres', 150);
            $table->string('apellidos', 150);
            $table->string('domicilio', 255);
            $table->date('fecha_nacimiento');
            $table->string('email', 150);
            $table->string('telefono', 15);
            $table->string('celular', 15);
            $table->string('ine', 18);
            $table->string('curp', 18);
            $table->string('nss', 11);
            $table->string('infonavit', 20)->nullable();
            $table->unsignedBigInteger('fk_id_puesto');
            $table->unsignedBigInteger('fk_id_sucursal');
            $table->date('fecha_contratacion');
            $table->date('fecha_sal')->nullable();
            $table->string('status')->default('activo');
            $table->string('imagen')->nullable();
            $table->timestamps();

            // Crear claves foráneas normalmente
            $table->foreign('fk_id_puesto')
                ->references('id_puesto')->on('tbl_puestos')
                ->onDelete('cascade');

            $table->foreign('fk_id_sucursal')
                ->references('id_sucursal')->on('tbl_sucursales')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        // IMPORTANTE: eliminar primero las foreign keys para evitar errores al hacer rollback
        Schema::table('tbl_empleados', function (Blueprint $table) {
            $table->dropForeign(['fk_id_puesto']);
            $table->dropForeign(['fk_id_sucursal']);
        });

        Schema::dropIfExists('tbl_empleados');
    }
}