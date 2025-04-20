<?php

// database/seeders/SucursalesTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sucursal;

class SucursalesTableSeeder extends Seeder
{
    public function run()
    {
        $nombres = [
            'Sucursal Central', 'Sucursal Norte', 'Sucursal Sur', 'Sucursal Este', 'Sucursal Oeste',
            'Sucursal Mérida', 'Sucursal Guadalajara', 'Sucursal Monterrey', 'Sucursal Tijuana', 'Sucursal Puebla',
            'Sucursal Cancún', 'Sucursal Oaxaca', 'Sucursal León', 'Sucursal Veracruz', 'Sucursal Morelia',
            'Sucursal Chihuahua', 'Sucursal Mazatlán', 'Sucursal Acapulco', 'Sucursal Querétaro', 'Sucursal San Luis Potosí'
        ];

        foreach ($nombres as $nombre) {
            Sucursal::create([
                'nombre_sucursal'    => $nombre,
                'direccion'          => 'Calle Ficticia #'.rand(1,999).', Col. Centro',
                'telefono_1'         => '555-' . rand(1000, 9999),
                'telefono_2'         => '556-' . rand(1000, 9999),
                'celular'            => '55' . rand(10000000, 99999999),
                'responsable'        => 'Responsable ' . explode(' ', $nombre)[1],
                'email_responsable'  => strtolower(str_replace(' ', '', $nombre)) . '@empresa.com',
                'status_sucursal'    => rand(0, 1) ? 'activo' : 'inactivo',
            ]);
        }
    }
}
