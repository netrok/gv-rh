<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SucursalesExport;
use Barryvdh\DomPDF\Facade\Pdf;


class SucursalController extends Controller
{


public function exportExcel()
{
    return Excel::download(new SucursalesExport, 'sucursales.xlsx');
}

public function exportPDF()
{
    $sucursales = Sucursal::all();
    $pdf = Pdf::loadView('sucursales.pdf', compact('sucursales'));
    return $pdf->download('sucursales.pdf');
}

    // Mostrar todas las sucursales
    public function index(Request $request)
{
    $query = Sucursal::query();

    if ($request->filled('nombre')) {
        $query->where('nombre_sucursal', 'ilike', '%' . $request->nombre . '%');
    }

    if ($request->filled('estado')) {
        $query->where('status_sucursal', $request->estado);
    }

    $sucursales = $query->orderBy('nombre_sucursal')->paginate(10)->withQueryString();

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
            'nombre_sucursal' => 'required|string|max:255',
            'direccion' => 'required|string',
            'telefono_1' => 'required|string',
            'telefono_2' => 'nullable|string',
            'celular' => 'required|string',
            'responsable' => 'required|string',
            'email_responsable' => 'required|email',
            'status_sucursal' => 'required|in:activo,inactivo',
        ]);
    
        Sucursal::create($request->all());
    
        return redirect()->route('sucursales.index')->with('success', 'Sucursal creada correctamente.');
    }

    // Mostrar los detalles de una sucursal
    public function show(Sucursal $sucursal)
    {
        return view('sucursales.show', compact('sucursal'));
    }

    // Mostrar el formulario para editar una sucursal
    public function edit(Sucursal $sucursal)
    {
        return view('sucursales.edit', compact('sucursal'));
    }

    // Actualizar una sucursal en la base de datos
    public function update(Request $request, Sucursal $sucursal)
    {
        // Validación (puedes personalizarla según lo que necesites)
        $request->validate([
            'nombre_sucursal' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono_1' => 'required|string|max:15',
            'telefono_2' => 'nullable|string|max:15',
        ]);
    
        // Actualizamos los campos
        $sucursal->nombre_sucursal = $request->nombre_sucursal;
        $sucursal->direccion = $request->direccion;
        $sucursal->telefono_1 = $request->telefono_1;
        $sucursal->telefono_2 = $request->telefono_2;
    
        $sucursal->save(); // Guardamos los cambios
    
        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada correctamente');
    }
    // Eliminar una sucursal
    public function destroy(Sucursal $sucursal)
    {
        $sucursal->delete();

        return redirect()->route('sucursales.index')->with('success', 'Sucursal eliminada con éxito.');
    }
}