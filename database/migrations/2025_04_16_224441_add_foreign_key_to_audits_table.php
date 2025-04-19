<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToAuditsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('audits', function (Blueprint $table) {
            // Aquí agregas la clave foránea para la tabla audits
            $table->foreign('id_empleado')->references('id_empleado')->on('tbl_empleados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('audits', function (Blueprint $table) {
            $table->dropForeign(['id_empleado']);
        });
    }
}