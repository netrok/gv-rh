<?php

namespace App\Http\Controllers;

use App\Models\SolicitudVacacion;
use Illuminate\Http\Request;

class SolicitudVacacionController extends Controller
{
    // Mostrar todas las solicitudes de vacaciones
    public function index()
    {
        $solicitudes = SolicitudVacacion::all();
        return view('solicitudes.index', compact('solicitudes'));
    }

    // Mostrar el formulario para crear una nueva solicitud
    public function create()
    {
        return view('solicitudes.create');
    }

    // Almacenar una nueva solicitud
    public function store(Request $request)
    {
        $request->validate([
            'fk_num_empleado' => 'required|exists:tbl_empleados,num_empleado',
            'anio' => 'required|numeric',
            'dias_otorgados' => 'required|numeric',
            'dias_disfrutados' => 'required|numeric',
            'saldo' => 'required|numeric',
            'observaciones' => 'required',
            'estado_solicitud' => 'required',
            'fecha_solicitud' => 'required|date',
        ]);

        SolicitudVacacion::create($request->all());

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud de vacaciones creada con éxito.');
    }

    // Mostrar los detalles de una solicitud
    public function show($id)
    {
        $solicitud = SolicitudVacacion::findOrFail($id);
        return view('solicitudes.show', compact('solicitud'));
    }

    // Mostrar el formulario para editar una solicitud
    public function edit($id)
    {
        $solicitud = SolicitudVacacion::findOrFail($id);
        return view('solicitudes.edit', compact('solicitud'));
    }

    // Actualizar una solicitud
    public function update(Request $request, $id)
    {
        $request->validate([
            'fk_num_empleado' => 'required|exists:tbl_empleados,num_empleado',
            'anio' => 'required|numeric',
            'dias_otorgados' => 'required|numeric',
            'dias_disfrutados' => 'required|numeric',
            'saldo' => 'required|numeric',
            'observaciones' => 'required',
            'estado_solicitud' => 'required',
            'fecha_solicitud' => 'required|date',
        ]);

        $solicitud = SolicitudVacacion::findOrFail($id);
        $solicitud->update($request->all());

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada con éxito.');
    }

    // Eliminar una solicitud
    public function destroy($id)
    {
        $solicitud = SolicitudVacacion::findOrFail($id);
        $solicitud->delete();

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada con éxito.');
    }
}
