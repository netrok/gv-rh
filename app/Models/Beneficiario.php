<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    use HasFactory;

    protected $table = 'tbl_beneficiarios'; // Nombre de la tabla
    protected $primaryKey = 'id_beneficiario'; // Clave primaria

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'fk_num_empleado', 'nombres', 'apellidos', 'parentesco', 'porcentaje', 
        'rfc', 'domicilio'
    ];

    // Definir la relación con la tabla de empleados
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'fk_num_empleado');
    }
}
