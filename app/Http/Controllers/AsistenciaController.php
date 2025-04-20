<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::with('empleado')->orderBy('fecha', 'desc')->get();
        return view('asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        $empleados = Empleado::orderBy('nombres')->get(); // Asegúrate de tener el campo 'nombre' en tu tabla de empleados
        return view('asistencias.create', compact('empleados'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'fecha' => 'required|date',
            'hora_entrada' => 'required',
            'hora_salida' => 'nullable',
            'tipo' => 'required',
        ]);

        Asistencia::create($request->all());

        return redirect()->route('asistencias.index')->with('success', 'Asistencia registrada correctamente.');
    }
}