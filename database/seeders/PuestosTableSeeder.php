<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Puesto;

class PuestosTableSeeder extends Seeder
{
    public function run()
    {
        $puestos = [
            'Gerente General', 'Jefe de Ventas', 'Analista de Datos', 'Programador Backend',
            'Programador Frontend', 'Diseñador Gráfico', 'Contador', 'Asistente Administrativo',
            'Recepcionista', 'Auxiliar Contable', 'Jefe de Recursos Humanos', 'Reclutador',
            'Soporte Técnico', 'Community Manager', 'Marketing Digital', 'Desarrollador Fullstack',
            'Auditor Interno', 'Supervisor de Producción', 'Logística', 'Encargado de Compras'
        ];

        foreach ($puestos as $nombre) {
            Puesto::create([
                'nombre_puesto'  => $nombre,
                'sueldo_base'    => rand(8000, 25000),
                'jefe_directo'   => 'Lic. ' . fake()->lastName(),
                'status_puesto'  => rand(0, 1) ? 'activo' : 'inactivo',
            ]);
        }
    }
}
