<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\Sucursal;

class EmpleadosTableSeeder extends Seeder
{
    public function run()
    {
        $puestos = Puesto::pluck('id_puesto')->toArray();
        $sucursales = Sucursal::pluck('id_sucursal')->toArray();

        foreach (range(1, 20) as $i) {
            Empleado::create([
                'num_empleado'        => 'EMP' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nombres'             => fake()->firstName(),
                'apellidos'           => fake()->lastName(),
                'domicilio'           => fake()->address(),
                'fecha_nacimiento'    => fake()->date('Y-m-d', '-20 years'),
                'email'               => fake()->unique()->safeEmail(),
                'telefono'            => fake()->phoneNumber(),
                'celular'             => fake()->phoneNumber(),
                'ine'                 => strtoupper(fake()->bothify('###############')),
                'curp'                => strtoupper(fake()->bothify('????######??????##')),
                'nss'                 => fake()->numerify('###-##-####'),
                'infonavit'           => fake()->numerify('##########'),
                'fk_id_puesto'        => fake()->randomElement($puestos),
                'fk_id_sucursal'      => fake()->randomElement($sucursales),
                'fecha_contratacion'  => fake()->date('Y-m-d', '-2 years'),
                'fecha_sal'           => null,
                'status'              => fake()->randomElement(['activo', 'inactivo']),
                'imagen'              => 'default.png', // Asumiendo que usas una imagen por defecto
            ]);
        }
    }
}
