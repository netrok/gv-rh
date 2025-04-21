<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::with('empleado')->get(); // Carga la relación del empleado
        return view('asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        return view('asistencias.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:tbl_empleados,id_empleado',
            'fecha' => 'required|date',
            'hora_entrada' => 'required',
            'hora_salida' => 'nullable',
            'tipo' => 'required',
        ]);

        // Obtener el empleado
        $empleado = Empleado::find($request->empleado_id);

        Asistencia::create([
            'empleado_id' => $request->empleado_id,
            'fecha' => $request->fecha,
            'hora_entrada' => $request->hora_entrada,
            'hora_salida' => $request->hora_salida,
            'tipo' => strtolower($request->tipo),  // Asegúrate de que el tipo esté en minúsculas
            'observaciones' => $request->observaciones,
            'num_empleado' => $empleado->num_empleado,
        ]);

        return redirect()->route('asistencias.index')->with('success', 'Asistencia registrada correctamente.');
    }
}