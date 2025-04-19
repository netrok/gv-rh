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
            // Verificar si la restricción de clave foránea ya existe antes de agregarla
            if (!Schema::hasColumn('audits', 'id_empleado')) {
                $table->unsignedBigInteger('id_empleado')->nullable();
            }
            
            // Agregar la clave foránea solo si no existe
            if (!Schema::hasTable('tbl_empleados')) {
                return;
            }
            
            $table->foreign('id_empleado')->references('id_empleado')->on('tbl_empleados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('audits', function (Blueprint $table) {
            // Eliminar la clave foránea si existe
            $table->dropForeign(['id_empleado']);
        });
    }
}