<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Audit;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'tbl_empleados'; // Nombre de la tabla
    protected $primaryKey = 'id_empleado'; // Clave primaria

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'num_empleado',
        'nombres',
        'apellidos',
        'domicilio',
        'fecha_nacimiento',
        'email',
        'telefono',
        'celular',
        'ine',
        'curp',
        'nss',
        'infonavit',
        'fk_id_puesto',
        'fk_id_sucursal',
        'fecha_contratacion',
        'fecha_sal',
        'status',
        'imagen'
    ];

    // Definir las relaciones
    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'fk_id_puesto', 'id_puesto');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'fk_id_sucursal', 'id_sucursal');
    }


    public function beneficiarios()
    {
        return $this->hasMany(Beneficiario::class, 'fk_num_empleado');
    }

    public function solicitudesVacaciones()
    {
        return $this->hasMany(SolicitudVacacion::class, 'fk_num_empleado');
    }

    public static function boot()
    {
        parent::boot();

        static::updated(function ($empleado) {
            $changes = $empleado->getChanges();
            Audit::create([
                'id_empleado' => $empleado->id_empleado,
                'action' => 'updated',
                'changed_data' => json_encode($changes),
            ]);
        });

        static::deleted(function ($empleado) {
            Audit::create([
                'id_empleado' => $empleado->id_empleado,
                'action' => 'deleted',
                'changed_data' => json_encode($empleado->getOriginal()),
            ]);
        });
    }

    
}