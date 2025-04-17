<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'tbl_sucursales'; // Nombre de la tabla
    protected $primaryKey = 'id_sucursal'; // Clave primaria
    public $timestamps = true; // Si usas created_at y updated_at


    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre_sucursal', 'direccion', 'telefono_1', 'telefono_2', 
        'celular', 'responsable', 'email_responsable', 'status_sucursal'
    ];

    // Relación con empleados
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'fk_id_sucursal');
    }
}
