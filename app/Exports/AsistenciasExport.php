<?php
namespace App\Exports;

use App\Models\Asistencia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AsistenciasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Asistencia::with('empleado')->get()->map(function ($asistencia) {
            return [
                $asistencia->empleado->num_empleado ?? 'N/A',
                $asistencia->empleado->nombre_completo ?? 'Empleado eliminado',
                $asistencia->fecha,
                $asistencia->hora_entrada,
                $asistencia->hora_salida,
                ucfirst($asistencia->tipo),
                $asistencia->observaciones,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Núm. Empleado',
            'Nombre Completo',
            'Fecha',
            'Hora Entrada',
            'Hora Salida',
            'Tipo',
            'Observaciones',
        ];
    }
}