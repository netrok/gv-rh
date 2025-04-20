<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFkNumEmpleadoTypeInTblBeneficiarios extends Migration
{
    public function up(): void
    {
        Schema::table('tbl_beneficiarios', function (Blueprint $table) {
            $table->string('fk_num_empleado')->change();
        });
    }

    public function down(): void
    {
        Schema::table('tbl_beneficiarios', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_num_empleado')->change();
        });
    }
}