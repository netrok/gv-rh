<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use Illuminate\Http\Request;

class BeneficiarioController extends Controller
{
    // Mostrar todos los beneficiarios
    public function index()
    {
        $beneficiarios = Beneficiario::all();
        return view('beneficiarios.index', compact('beneficiarios'));
    }

    // Mostrar el formulario para crear un nuevo beneficiario
    public function create()
    {
        return view('beneficiarios.create');
    }

    // Almacenar un nuevo beneficiario
    public function store(Request $request)
    {
        $request->validate([
            'fk_num_empleado' => 'required|exists:tbl_empleados,num_empleado',
            'nombres' => 'required',
            'apellidos' => 'required',
            'parentesco' => 'required',
            'porcentaje' => 'required|numeric',
            'rfc' => 'required',
            'domicilio' => 'required',
        ]);

        Beneficiario::create($request->all()); // Crear beneficiario

        return redirect()->route('beneficiarios.index')->with('success', 'Beneficiario creado con éxito.');
    }

    // Mostrar los detalles de un beneficiario
    public function show($id)
    {
        $beneficiario = Beneficiario::findOrFail($id);
        return view('beneficiarios.show', compact('beneficiario'));
    }

    // Mostrar el formulario para editar un beneficiario
    public function edit($id)
    {
        $beneficiario = Beneficiario::findOrFail($id);
        return view('beneficiarios.edit', compact('beneficiario'));
    }

    // Actualizar un beneficiario
    public function update(Request $request, $id)
    {
        $request->validate([
            'fk_num_empleado' => 'required|exists:tbl_empleados,num_empleado',
            'nombres' => 'required',
            'apellidos' => 'required',
            'parentesco' => 'required',
            'porcentaje' => 'required|numeric',
            'rfc' => 'required',
            'domicilio' => 'required',
        ]);

        $beneficiario = Beneficiario::findOrFail($id);
        $beneficiario->update($request->all());

        return redirect()->route('beneficiarios.index')->with('success', 'Beneficiario actualizado con éxito.');
    }

    // Eliminar un beneficiario
    public function destroy($id)
    {
        $beneficiario = Beneficiario::findOrFail($id);
        $beneficiario->delete();

        return redirect()->route('beneficiarios.index')->with('success', 'Beneficiario eliminado con éxito.');
    }
}
