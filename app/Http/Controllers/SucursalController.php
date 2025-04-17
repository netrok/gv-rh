<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Exports\SucursalesExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class SucursalController extends Controller
{

   

public function exportPDF()
{
    $sucursales = \App\Models\Sucursal::all();

    $pdf = Pdf::loadView('sucursales.reporte', compact('sucursales'));
    return $pdf->download('sucursales.pdf');
}
   

public function exportExcel()
{
    return Excel::download(new SucursalesExport, 'sucursales.xlsx');
}
    public function __construct()
    {
        $this->middleware('auth'); // Asegura que solo usuarios autenticados accedan
    }

    // Listado de sucursales
    public function index()
{
    $sucursales = Sucursal::paginate(10); // O el número de registros por página que desees
    return view('sucursales.index', compact('sucursales'));
}

    // Mostrar formulario de creación
    public function create()
    {
        return view('sucursales.create');
    }

    // Guardar nueva sucursal
    public function store(Request $request)
    {
        $request->validate([
            'nombre_sucursal' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'telefono_1' => 'nullable|string|max:20',
            'telefono_2' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:100',
            'status_sucursal' => 'required|in:activo,inactivo',
        ]);

        Sucursal::create($request->all());

        return redirect()->route('sucursales.index')->with('success', 'Sucursal creada exitosamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        return view('sucursales.edit', compact('sucursal'));
    }

    // Actualizar sucursal
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_sucursal' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'telefono_1' => 'nullable|string|max:20',
            'telefono_2' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:100',
            'status_sucursal' => 'required|in:activo,inactivo',
        ]);

        $sucursal = Sucursal::findOrFail($id);
        $sucursal->update($request->all());

        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada correctamente.');
    }

    // Eliminar sucursal
    public function destroy($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $sucursal->delete();

        return redirect()->route('sucursales.index')->with('success', 'Sucursal eliminada correctamente.');
    }
}