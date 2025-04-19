<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_empleado',
        'accion',
        'changed_data',
    ];

    protected $casts = [
        'changed_data' => 'array',
    ];

    // Relación con el modelo de Empleado (opcional pero recomendable)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }
}