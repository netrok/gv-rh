<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->string('num_empleado'); // Cambiado a string
            $table->foreign('num_empleado')->references('num_empleado')->on('tbl_empleados')->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora_entrada')->nullable();
            $table->time('hora_salida')->nullable();
            $table->enum('tipo', ['presencial', 'remoto', 'permiso', 'falta'])->default('presencial');
            $table->string('observaciones')->nullable();
            $table->timestamps();
        
            $table->unique(['num_empleado', 'fecha']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};