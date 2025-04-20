<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSucursalesTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_sucursales', function (Blueprint $table) {
            $table->id('id_sucursal');  // ID de la sucursal
            $table->string('nombre_sucursal', 150);  // Nombre de la sucursal
            $table->text('direccion');  // Dirección de la sucursal
            $table->string('telefono_1', 15);  // Teléfono 1, ahora con más longitud
            $table->string('telefono_2', 15)->nullable();  // Teléfono 2, ahora es nullable
            $table->string('celular', 15);  // Celular
            $table->string('responsable', 255);  // Nombre del responsable
            $table->string('email_responsable', 255);  // Correo del responsable
            $table->string('status_sucursal', 20)->default('activo');  // Estado de la sucursal, por defecto 'activo'
            $table->timestamps();  // Tiempos de creación y actualización
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_sucursales');  // Eliminar la tabla si ya existe
    }
}