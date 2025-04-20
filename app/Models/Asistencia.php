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
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'num_empleado', 'num_empleado');
    }
}