<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Empleado;
use Illuminate\Http\Request;

class BeneficiarioController extends Controller
{
    // ------------------- Mostrar todos los beneficiarios -------------------
    public function index(Request $request)
    {
        $query = Beneficiario::query();

        if ($request->filled('nombre')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombres', 'like', '%' . $request->nombre . '%')
                    ->orWhere('apellidos', 'like', '%' . $request->nombre . '%');
            });
        }

        if ($request->filled('rfc')) {
            $query->where('rfc', 'like', '%' . $request->rfc . '%');
        }

        $beneficiarios = $query->paginate(10);

        return view('beneficiarios.index', compact('beneficiarios'));
    }

    // ------------------- Generar PDF del beneficiario -------------------
    public function generarPdf($id)
    {
        $beneficiario = Beneficiario::findOrFail($id);
        $pdf = \PDF::loadView('beneficiarios.pdf', compact('beneficiario'));

        return $pdf->stream('beneficiario_' . $beneficiario->id_beneficiario . '.pdf');
    }

    // ------------------- Formulario para crear nuevo beneficiario -------------------
    public function create()
    {
        $empleados = Empleado::all();
        return view('beneficiarios.create', compact('empleados'));
    }

    // ------------------- Almacenar nuevo beneficiario -------------------
    public function store(Request $request)
    {
        $request->validate([
            'fk_num_empleado' => 'required|exists:tbl_empleados,num_empleado',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'parentesco' => 'required|string|max:100',
            'porcentaje' => 'required|numeric|min:0|max:100',
            'rfc' => 'required|string|max:13',
            'domicilio' => 'required|string|max:255',
        ]);

        Beneficiario::create($request->all());

        return redirect()
            ->route('beneficiarios.index')
            ->with('success', 'Beneficiario creado con éxito.');
    }

    // ------------------- Mostrar detalles de un beneficiario -------------------
    public function show($id)
    {
        $beneficiario = Beneficiario::findOrFail($id);
        return view('beneficiarios.show', compact('beneficiario'));
    }

    // ------------------- Formulario para editar beneficiario -------------------
    public function edit($id)
    {
        $beneficiario = Beneficiario::findOrFail($id);
        $empleados = Empleado::all();

        return view('beneficiarios.edit', compact('beneficiario', 'empleados'));
    }

    // ------------------- Actualizar beneficiario -------------------
    public function update(Request $request, $id)
    {
        $request->validate([
            'fk_num_empleado' => 'required|exists:tbl_empleados,num_empleado',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'parentesco' => 'required|string|max:100',
            'porcentaje' => 'required|numeric|min:0|max:100',
            'rfc' => 'required|string|max:13',
            'domicilio' => 'required|string|max:255',
        ]);

        $beneficiario = Beneficiario::findOrFail($id);
        $beneficiario->update($request->all());

        return redirect()
            ->route('beneficiarios.index')
            ->with('success', 'Beneficiario actualizado correctamente.');
    }

    // ------------------- Eliminar beneficiario -------------------
    public function destroy($id)
    {
        $beneficiario = Beneficiario::findOrFail($id);
        $beneficiario->delete();

        return redirect()
            ->route('beneficiarios.index')
            ->with('success', 'Beneficiario eliminado con éxito.');
    }
}