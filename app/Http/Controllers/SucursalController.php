<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    // Mostrar todas las sucursales
    public function index()
    {
        $sucursales = Sucursal::all(); // Obtener todas las sucursales
        return view('sucursales.index', compact('sucursales'));
    }

    // Mostrar el formulario para crear una nueva sucursal
    public function create()
    {
        return view('sucursales.create');
    }

    // Almacenar una nueva sucursal en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre_sucursal' => 'required|unique:tbl_sucursales',
            'direccion' => 'required',
            'telefono_1' => 'required',
            'telefono_2' => 'required',
            'celular' => 'required',
            'responsable' => 'required',
            'email_responsable' => 'required|email',
            'status_suursal' => 'required',
        ]);

        Sucursal::create($request->all()); // Crear la sucursal

        return redirect()->route('sucursales.index')->with('success', 'Sucursal creada con éxito.');
    }

    // Mostrar los detalles de una sucursal
    public function show($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        return view('sucursales.show', compact('sucursal'));
    }

    // Mostrar el formulario para editar una sucursal
    public function edit($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        return view('sucursales.edit', compact('sucursal'));
    }

    // Actualizar una sucursal en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_sucursal' => 'required|unique:tbl_sucursales,nombre_sucursal,' . $id,
            'direccion' => 'required',
            'telefono_1' => 'required',
            'telefono_2' => 'required',
            'celular' => 'required',
            'responsable' => 'required',
            'email_responsable' => 'required|email',
            'status_suursal' => 'required',
        ]);

        $sucursal = Sucursal::findOrFail($id);
        $sucursal->update($request->all()); // Actualizar la sucursal

        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada con éxito.');
    }

    // Eliminar una sucursal
    public function destroy($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $sucursal->delete(); // Eliminar la sucursal

        return redirect()->route('sucursales.index')->with('success', 'Sucursal eliminada con éxito.');
    }
}
