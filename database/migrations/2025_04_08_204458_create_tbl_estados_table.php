<?php

// database/migrations/YYYY_MM_DD_create_tbl_estados_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblEstadosTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_estados', function (Blueprint $table) {
            $table->id('id_estado');
            $table->string('nombre', 20)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_estados');
    }
}
