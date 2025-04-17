<?php
namespace App\Exports;

use App\Models\Sucursal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SucursalesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Sucursal::select('nombre_sucursal', 'direccion', 'telefono_1', 'telefono_2', 'celular', 'responsable', 'email_responsable', 'status_sucursal')->get();
    }

    public function headings(): array
    {
        return ['Nombre', 'Dirección', 'Teléfono 1', 'Teléfono 2', 'Celular', 'Responsable', 'Email', 'Estado'];
    }
}