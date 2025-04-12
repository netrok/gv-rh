<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudVacacion extends Model
{
    use HasFactory;

    protected $table = 'tbl_solicitudes_vacaciones'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'fk_num_empleado', 'anio', 'dias_otorgados', 'dias_disfrutados', 'saldo',
        'observaciones', 'estado_solicitud', 'fecha_solicitud'
    ];

    // Definir la relación con la tabla de empleados
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'fk_num_empleado');
    }
}
