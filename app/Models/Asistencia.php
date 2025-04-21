<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';

    protected $fillable = [
        'empleado_id',
        'fecha',
        'hora_entrada',
        'hora_salida',
        'tipo',
        'observaciones',
        'num_empleado', // 👈 necesario si la columna existe en la tabla
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id_empleado');
    }


    public function scopeBuscar($query, $termino)
    {
        if ($termino) {
            $query->whereHas('empleado', function ($q) use ($termino) {
                $q->where('nombres', 'ILIKE', "%$termino%")
                    ->orWhere('apellidos', 'ILIKE', "%$termino%")
                    ->orWhere('num_empleado', 'ILIKE', "%$termino%");
            });
        }
    }

    public function scopeFecha($query, $fecha)
    {
        if ($fecha) {
            $query->whereDate('fecha', $fecha);
        }
    }

}