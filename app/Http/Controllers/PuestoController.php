<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    // Mostrar todos los puestos
    public function index(Request $request)
{
    $query = Puesto::query();

    if ($request->filled('nombre')) {
        $query->where('nombre_puesto', 'like', '%' . $request->nombre . '%');
    }

    if ($request->filled('status')) {
        $query->where('status_puesto', $request->status);
    }

    $puestos = $query->paginate(10); // <-- ¡ESTO es clave!

    return view('puestos.index', compact('puestos'));
}
    // Mostrar el formulario para crear un nuevo puesto
    public function create()
    {
        return view('puestos.create');
    }

    // Almacenar un nuevo puesto en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre_puesto' => 'required|unique:tbl_puestos',
            'sueldo_base' => 'required|numeric',
            'jefe_directo' => 'required',
            'status_puesto' => 'required',
        ]);

        Puesto::create($request->all()); // Crear el puesto

        return redirect()->route('puestos.index')->with('success', 'Puesto creado con éxito.');
    }

    // Mostrar los detalles de un puesto
    public function show($id)
    {
        $puesto = Puesto::findOrFail($id);
        return view('puestos.show', compact('puesto'));
    }

    // Mostrar el formulario para editar un puesto
    public function edit($id)
    {
        $puesto = Puesto::findOrFail($id);
        return view('puestos.edit', compact('puesto'));
    }

    // Actualizar un puesto en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_puesto' => 'required|unique:tbl_puestos,nombre_puesto,' . $id . ',id_puesto',
            'sueldo_base' => 'required|numeric',
            'jefe_directo' => 'required',
            'status_puesto' => 'required',
        ]);

        $puesto = Puesto::findOrFail($id);
        $puesto->update($request->all()); // Actualizar el puesto

        return redirect()->route('puestos.index')->with('success', 'Puesto actualizado con éxito.');
    }

    // Eliminar un puesto
    public function destroy($id)
    {
        $puesto = Puesto::findOrFail($id);
        $puesto->delete(); // Eliminar el puesto

        return redirect()->route('puestos.index')->with('success', 'Puesto eliminado con éxito.');
    }
}
