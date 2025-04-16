<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
   // database/migrations/2025_04_14_234300_create_audits_table.php
public function up()
{
    Schema::create('audits', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_empleado'); // solo la columna
        $table->text('accion');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
