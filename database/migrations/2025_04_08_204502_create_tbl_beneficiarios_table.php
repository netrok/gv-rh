<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBeneficiariosTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_beneficiarios', function (Blueprint $table) {
            $table->id('id_beneficiario');
            $table->unsignedBigInteger('fk_num_empleado');
            $table->string('nombres', 150);
            $table->string('apellidos', 150);
            $table->string('parentesco', 100);
            $table->decimal('porcentaje', 5, 2);
            $table->string('rfc', 20);
            $table->text('domicilio');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_beneficiarios');
    }
}
