<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;

    protected $table = 'tbl_puestos'; // Nombre de la tabla
    protected $primaryKey = 'id_puesto'; // Clave primaria
    public $timestamps = true; // Si usas created_at y updated_at


    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre_puesto', 'sueldo_base', 'jefe_directo', 'status_puesto'
    ];

    // Relación con empleados
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'fk_id_puesto');
    }
}
