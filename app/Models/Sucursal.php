<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    // Especificamos la tabla si no sigue la convención de nombres pluralizados
    protected $table = 'tbl_sucursales';

    // Establecemos la clave primaria si no usas 'id' por defecto
    protected $primaryKey = 'id_sucursal'; 

    // Configuramos si la clave primaria es autoincrementable
    public $incrementing = true;

    // Definimos el tipo de la clave primaria
    protected $keyType = 'int';

    // Activamos los timestamps para 'created_at' y 'updated_at'
    public $timestamps = true; 

    // Especificamos los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre_sucursal',
        'direccion',
        'telefono_1',
        'telefono_2',
        'celular',
        'responsable',
        'email_responsable',
        'status_sucursal',
    ];

    // Relación con la tabla de empleados (si tienes una relación de 1:N)
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'fk_id_sucursal', 'id_sucursal');
        // 'fk_id_sucursal' es el nombre de la clave foránea en la tabla empleados
        // 'id_sucursal' es el campo clave primaria de la tabla sucursales
    }
}