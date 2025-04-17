<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Exports\SucursalesExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    // Constantes para estado
    const ESTADO_ACTIVO = 'activo';
    const ESTADO_INACTIVO = 'inactivo';

    // Middleware para asegurar que solo los usuarios autenticados accedan
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Exportar Sucursales a PDF
    public function exportPDF()
    {
        $sucursales = Sucursal::all(); // Obtener todas las sucursales
        $pdf = Pdf::loadView('sucursales.reporte', compact('sucursales'));

        return $pdf->download('sucursales.pdf');
    }

    // Exportar Sucursales a Excel
    public function exportExcel()
    {
        return Excel::download(new SucursalesExport, 'sucursales.xlsx');
    }

    // Listado de sucursales con filtros
    public function index(Request $request)
    {
        $query = Sucursal::query();

        // Filtro por nombre
        if ($request->filled('nombre')) {
            $query->where('nombre_sucursal', 'like', '%' . $request->nombre . '%');
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('status_sucursal', $request->estado);
        }

        // Obtener las sucursales con paginación
        $sucursales = $query->paginate(10);

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
            'status_sucursal' => 'required|in:' . self::ESTADO_ACTIVO . ',' . self::ESTADO_INACTIVO,
        ]);

        Sucursal::create($request->all());

        return redirect()->route('sucursales.index')->with('success', 'Sucursal creada exitosamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $sucursal = Sucursal::findOrFail($id); // Buscar sucursal
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
            'status_sucursal' => 'required|in:' . self::ESTADO_ACTIVO . ',' . self::ESTADO_INACTIVO,
        ]);

        $sucursal = Sucursal::findOrFail($id); // Buscar sucursal
        $sucursal->update($request->all()); // Actualizar

        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada correctamente.');
    }

    // Eliminar sucursal
    public function destroy($id)
    {
        $sucursal = Sucursal::findOrFail($id); // Buscar sucursal
        $sucursal->delete(); // Eliminar

        return redirect()->route('sucursales.index')->with('success', 'Sucursal eliminada correctamente.');
    }
}