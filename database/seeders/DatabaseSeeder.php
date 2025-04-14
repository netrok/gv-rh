<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $permissions = [
            'ver empleados',
            'crear empleados',
            'editar empleados',
            'eliminar empleados',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $empleado = Role::firstOrCreate(['name' => 'empleado']);

        // Asignar permisos a los roles
        $admin->givePermissionTo(Permission::all());
        $empleado->givePermissionTo(['ver empleados']);

        // Asignar rol a usuario administrador (ajusta el ID según sea necesario)
        $user = User::find(1);
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
