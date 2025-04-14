<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserWithRolesSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar tablas
        \DB::table('role_has_permissions')->truncate();
        \DB::table('model_has_roles')->truncate();
        \DB::table('model_has_permissions')->truncate();
        \DB::table('users')->truncate();
        \DB::table('roles')->truncate();
        \DB::table('permissions')->truncate();

        // Crear permisos de ejemplo
        $permissions = ['ver empleados', 'crear empleados', 'editar empleados', 'eliminar empleados'];

        foreach ($permissions as $perm) {
            Permission::create(['name' => $perm]);
        }

        // Crear rol admin y asignar permisos
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());

        // Crear usuario admin
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
        ]);

        $admin->assignRole($adminRole);

        // Crear otro rol (opcional)
        $empleadoRole = Role::create(['name' => 'empleado']);
        $empleadoRole->givePermissionTo(['ver empleados']);

        // Crear usuario con rol empleado (opcional)
        $empleado = User::create([
            'name' => 'Empleado Prueba',
            'email' => 'empleado@example.com',
            'password' => Hash::make('empleado123'),
        ]);

        $empleado->assignRole($empleadoRole);

        echo "Usuarios y roles creados correctamente.\n";
    }
}
