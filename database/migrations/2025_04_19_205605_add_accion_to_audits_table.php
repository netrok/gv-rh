<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Verificar si la columna no existe antes de agregarla
        if (!Schema::hasColumn('audits', 'accion')) {
            Schema::table('audits', function (Blueprint $table) {
                $table->string('accion')->after('id_empleado');
            });
        }
    }

    public function down()
    {
        // Verificar si la columna existe antes de eliminarla
        if (Schema::hasColumn('audits', 'accion')) {
            Schema::table('audits', function (Blueprint $table) {
                $table->dropColumn('accion');
            });
        }
    }
};