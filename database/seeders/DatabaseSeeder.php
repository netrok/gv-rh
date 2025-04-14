<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear permisos
        $permissions = [
            'ver empleados',
            'crear empleados',
            'editar empleados',
            'eliminar empleados',
            'ver beneficiarios',
            'crear beneficiarios',
            'editar beneficiarios',
            'eliminar beneficiarios'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles y asignar permisos
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions(['ver empleados', 'ver beneficiarios']);

        // Crear usuario admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('riesenhammer')
            ]
        );

        $admin->assignRole('admin');
    }
}
