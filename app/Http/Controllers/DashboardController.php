<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Sucursal;
use App\Models\Puesto;
use App\Models\Asistencia;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmpleados = Empleado::count();
        $totalSucursales = Sucursal::count();
        $totalPuestos = Puesto::count();
        $asistenciasHoy = Asistencia::whereDate('fecha', Carbon::today())->count();
        $cumpleaneros = Empleado::whereMonth('fecha_nacimiento', Carbon::now()->month)->get();

        $empleadosPorSucursal = Empleado::selectRaw('fk_id_sucursal, count(*) as total')
            ->groupBy('fk_id_sucursal')
            ->with('sucursal')
            ->get();

        return view('dashboard.index', compact(
            'totalEmpleados',
            'totalSucursales',
            'totalPuestos',
            'asistenciasHoy',
            'cumpleaneros',
            'empleadosPorSucursal'
        ));
    }
}
