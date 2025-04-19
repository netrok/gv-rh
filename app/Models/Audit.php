<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = ['id_empleado', 'accion', 'changed_data'];

    protected $casts = [
        'changed_data' => 'array',
    ];
}
