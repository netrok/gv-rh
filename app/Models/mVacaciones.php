<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mVacaciones extends Model
{
    use HasFactory;

    protected $table = 'tbl_vacaciones'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    protected $fillable = [
        'fk_num_empleado',
        'anio',
        'dias_otorgados',
        'dias_disfrutados',
        'saldo',
        'observaciones',
        'estado_solicitud',
        'fecha_solicitud'
    ];

    // Relación con el modelo Empleado usando fk_num_empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'fk_num_empleado', 'num_empleado');
    }
}
