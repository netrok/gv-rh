<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AsignarRolAdminSeeder extends Seeder
{
    public function run()
    {
        // Buscar el usuario por correo
        $user = User::where('email', 'ernesto.ramirez@gv.com.mx')->first();

        if (!$user) {
            $this->command->error('❌ Usuario no encontrado.');
            return;
        }

        // Verificar si el rol admin existe, si no, lo crea
        $role = Role::firstOrCreate(['name' => 'admin']);

        // Asignar el rol
        $user->assignRole($role);

        $this->command->info('✅ Rol admin asignado correctamente al usuario.');
    }
}