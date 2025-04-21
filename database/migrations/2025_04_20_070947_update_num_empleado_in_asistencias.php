<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('asistencias', function (Blueprint $table) {
            // Verificar si la columna 'num_empleado' existe antes de modificarla
            if (Schema::hasColumn('asistencias', 'num_empleado')) {
                $table->string('num_empleado', 30)->nullable(false)->change();
            } else {
                // Si no existe, crearla
                $table->string('num_empleado', 30)->nullable(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asistencias', function (Blueprint $table) {
            if (Schema::hasColumn('asistencias', 'num_empleado')) {
                $table->dropColumn('num_empleado');
            }
        });
    }
};