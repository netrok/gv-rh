<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_empleado')->nullable();
            $table->string('accion');
            $table->json('changed_data')->nullable();
            $table->timestamps();

            $table->foreign('id_empleado')->references('id_empleado')->on('tbl_empleados')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};