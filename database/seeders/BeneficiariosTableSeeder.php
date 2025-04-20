<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beneficiario;
use App\Models\Empleado;

class BeneficiariosTableSeeder extends Seeder
{
    public function run()
    {
        $empleados = Empleado::pluck('num_empleado')->toArray();
        $parentescos = ['Padre', 'Madre', 'Hermano(a)', 'Hijo(a)', 'Esposo(a)'];

        foreach (range(1, 20) as $i) {
            Beneficiario::create([
                'fk_num_empleado' => fake()->randomElement($empleados),
                'nombres'         => fake()->firstName(),
                'apellidos'       => fake()->lastName(),
                'parentesco'      => fake()->randomElement($parentescos),
                'porcentaje'      => fake()->numberBetween(10, 100),
                'rfc'             => strtoupper(fake()->bothify('????#########')),
                'domicilio'       => fake()->address(),
            ]);
        }
    }
}