<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;  // Importa el modelo User correctamente
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Crear roles si no existen
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'usuario']);

        // Crear permisos
        $verEmpleados = Permission::firstOrCreate(['name' => 'ver empleados']);
        $crearEmpleados = Permission::firstOrCreate(['name' => 'crear empleados']);
        $editarEmpleados = Permission::firstOrCreate(['name' => 'editar empleados']);
        $eliminarEmpleados = Permission::firstOrCreate(['name' => 'eliminar empleados']);

        // Asignar permisos a roles
        $adminRole->givePermissionTo([$verEmpleados, $crearEmpleados, $editarEmpleados, $eliminarEmpleados]);
        $userRole->givePermissionTo([$verEmpleados]);

        // Crear usuario admin por defecto si no existe
        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'],  // Verifica si el usuario ya existe
            ['name' => 'Admin', 'password' => bcrypt('password123')]
        );

        // Asignar el rol de admin al usuario
        $user->assignRole('admin');
    }
}

