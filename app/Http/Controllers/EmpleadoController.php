<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpleadoController extends Controller
{
    // Mostrar todos los empleados
    public function index()
    {
        $empleados = Empleado::with(['puesto', 'sucursal'])->get();
        return view('empleados.index', compact('empleados'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $puestos = Puesto::all();
        $sucursales = Sucursal::all();
        return view('empleados.create', compact('puestos', 'sucursales'));
    }

    // Guardar un nuevo empleado
    public function store(Request $request)
    {
        $request->validate([
            'num_empleado' => 'required|integer|unique:tbl_empleados,num_empleado',
            'nombres' => 'required|string|max:150',
            'apellidos' => 'required|string|max:150',
            'domicilio' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'email' => 'required|email|unique:tbl_empleados,email',
            'telefono' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'ine' => 'nullable|string|max:20',
            'curp' => 'nullable|string|max:20',
            'nss' => 'nullable|string|max:20',
            'infonavit' => 'nullable|string|max:20',
            'fk_id_puesto' => 'required|exists:tbl_puestos,id_puesto',
            'fk_id_sucursal' => 'required|exists:tbl_sucursales,id_sucursal',
            'fecha_contratacion' => 'required|date',
            'status' => 'required|string|in:activo,inactivo',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $empleado = new Empleado($request->except('imagen'));

        if ($request->hasFile('imagen')) {
            $empleado->imagen = $request->file('imagen')->store('empleados', 'public');
        }

        $empleado->save();

        return redirect()->route('empleados.index')->with('success', 'Empleado creado con éxito.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $empleado = Empleado::with(['puesto', 'sucursal'])->findOrFail($id);
        $puestos = Puesto::all();
        $sucursales = Sucursal::all();

        return view('empleados.edit', compact('empleado', 'puestos', 'sucursales'));
    }

    // Actualizar empleado
    public function update(Request $request, $id)
{
    $empleado = Empleado::findOrFail($id);

    $request->validate([
        'num_empleado' => 'required|integer|unique:tbl_empleados,num_empleado,' . $id . ',id_empleado',
        'nombres' => 'required|string|max:150',
        'apellidos' => 'required|string|max:150',
        'domicilio' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'email' => 'required|email|unique:tbl_empleados,email,' . $id . ',id_empleado',
        'telefono' => 'nullable|string|max:20',
        'celular' => 'nullable|string|max:20',
        'ine' => 'nullable|string|max:20',
        'curp' => 'nullable|string|max:20',
        'nss' => 'nullable|string|max:20',
        'infonavit' => 'nullable|string|max:20',
        'fk_id_puesto' => 'required|exists:tbl_puestos,id_puesto',
        'fk_id_sucursal' => 'required|exists:tbl_sucursales,id_sucursal',
        'fecha_contratacion' => 'required|date',
        'status' => 'required|string|in:activo,inactivo',
        'imagen' => 'nullable|image|max:2048',
    ]);

    // Actualiza los datos excepto la imagen
    $empleado->fill($request->except('imagen'));

    // Si se sube una nueva imagen
    if ($request->hasFile('imagen')) {
        // Eliminar la imagen anterior si existe
        if ($empleado->imagen) {
            Storage::delete('public/' . $empleado->imagen);
        }

        // Guardar nueva imagen
        $empleado->imagen = $request->file('imagen')->store('empleados', 'public');
    }

    $empleado->save();

    return redirect()->route('empleados.index')->with('success', 'Empleado actualizado con éxito.');
}

    // Eliminar empleado
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
    }
}