<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        // Obtener todos los empleados para mostrar en el formulario
        $empleados = Empleado::all();
        return view('asistencias.index', compact('empleados'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'num_empleado' => 'required|exists:tbl_empleados,num_empleado',
            'fecha' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salida' => 'required|date_format:H:i',
            'tipo' => 'required|string',
            'observaciones' => 'nullable|string',
        ]);

        // Crear una nueva asistencia
        Asistencia::create($validated);

        // Redirigir con un mensaje de éxito
        return redirect()->route('asistencias.index')->with('success', 'Asistencia registrada correctamente');
    }
}