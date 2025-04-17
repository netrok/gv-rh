<?php

namespace App\Http\Controllers;

use App\Models\Empleado;

class DashboardController extends Controller
{
    public function index()
    {
        $empleadosCount = Empleado::count();
        $empleadosActivosCount = Empleado::where('status', 'activo')->count();
        $empleadosInactivosCount = Empleado::where('status', 'inactivo')->count();

        return view('dashboard.index', compact(
            'empleadosCount',
            'empleadosActivosCount',
            'empleadosInactivosCount'
        ));
    }
}