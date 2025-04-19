<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Verificar si la columna no existe antes de agregarla
        if (!Schema::hasColumn('audits', 'changed_data')) {
            Schema::table('audits', function (Blueprint $table) {
                $table->json('changed_data')->nullable();
            });
        }
    }

    public function down()
    {
        // Verificar si la columna existe antes de eliminarla
        if (Schema::hasColumn('audits', 'changed_data')) {
            Schema::table('audits', function (Blueprint $table) {
                $table->dropColumn('changed_data');
            });
        }
    }
};