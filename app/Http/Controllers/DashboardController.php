<?php

use App\Models\Empleado;

public function index()
{
    $empleadosCount = Empleado::count();
    $empleadosActivosCount = Empleado::where('status', 'activo')->count();
    $empleadosInactivosCount = Empleado::where('status', 'inactivo')->count();

    return view('dashboard', compact('empleadosCount', 'empleadosActivosCount', 'empleadosInactivosCount'));
}