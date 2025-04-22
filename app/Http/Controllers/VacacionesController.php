<?php

namespace App\Http\Controllers;

use App\Models\mVacaciones;
use Illuminate\Http\Request;
use App\Models\Empleado;

class VacacionesController extends Controller
{
    public function index()
    {
        $vacaciones = mVacaciones::all();
        return view('vacaciones.index', compact('vacaciones'));
    }

    public function create()
    {
        // ✅ Agregamos esta línea para enviar los empleados a la vista
        $empleados = Empleado::all();
        return view('vacaciones.create', compact('empleados'));
    }

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

        mVacaciones::create($request->all());

        return redirect()->route('vacaciones.index')->with('success', 'Registro de vacaciones creado con éxito.');
    }

    public function show($id)
    {
        $vacacion = mVacaciones::findOrFail($id);
        return view('vacaciones.show', compact('vacacion'));
    }

    public function edit($id)
{
    $vacacion = mVacaciones::findOrFail($id);
    $empleados = Empleado::all(); // Variable correcta para la lista de empleados
    return view('vacaciones.edit', ['vacacion' => $vacacion, 'empleados' => $empleados]); // Se pasa 'solicitud' a la vista
}


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

        $vacacion = mVacaciones::findOrFail($id);
        $vacacion->update($request->all());

        return redirect()->route('vacaciones.index')->with('success', 'Registro de vacaciones actualizado con éxito.');
    }

    public function destroy($id)
    {
        $vacacion = mVacaciones::findOrFail($id);
        $vacacion->delete();

        return redirect()->route('vacaciones.index')->with('success', 'Registro de vacaciones eliminado con éxito.');
    }
}
