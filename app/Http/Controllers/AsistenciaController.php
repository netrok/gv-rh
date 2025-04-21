<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF; // Asegúrate de usar este alias


class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        $asistencias = Asistencia::with('empleado')
            ->when($request->buscar, function ($query) use ($request) {
                $query->whereHas('empleado', function ($q) use ($request) {
                    $q->whereRaw("CONCAT(nombres, ' ', apellidos) ILIKE ?", ['%' . $request->buscar . '%'])
                        ->orWhere('num_empleado', 'like', '%' . $request->buscar . '%');
                });
            })
            ->when($request->fecha, function ($query) use ($request) {
                $query->whereDate('fecha', $request->fecha);
            })
            ->paginate(10); // Puedes cambiar 10 por la cantidad deseada

        return view('asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        return view('asistencias.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:tbl_empleados,id_empleado',
            'fecha' => 'required|date',
            'hora_entrada' => 'required',
            'hora_salida' => 'nullable',
            'tipo' => 'required',
        ]);

        // Obtener el empleado
        $empleado = Empleado::find($request->empleado_id);

        Asistencia::create([
            'empleado_id' => $request->empleado_id,
            'fecha' => $request->fecha,
            'hora_entrada' => $request->hora_entrada,
            'hora_salida' => $request->hora_salida,
            'tipo' => strtolower($request->tipo),
            'observaciones' => $request->observaciones,
            'num_empleado' => $empleado->num_empleado,
        ]);

        return redirect()->route('asistencias.index')->with('success', 'Asistencia registrada correctamente.');
    }

    public function reporte(Request $request)
    {
        $empleados = Empleado::all();
        $asistencias = [];

        if ($request->empleado_id) {
            $asistencias = Asistencia::where('empleado_id', $request->empleado_id)
                ->orderBy('fecha', 'desc')
                ->get();
        }

        return view('asistencias.reporte', compact('empleados', 'asistencias'));
    }

    public function reportePdf($empleado_id)
    {
        $empleado = Empleado::findOrFail($empleado_id);
        $asistencias = Asistencia::where('empleado_id', $empleado_id)
            ->orderBy('fecha', 'desc')
            ->get();

        // Cambia 'Pdf' por 'PDF'
        $pdf = PDF::loadView('asistencias.reporte_pdf', compact('empleado', 'asistencias'));
        
        return $pdf->download('reporte_asistencia_' . $empleado->num_empleado . '.pdf');
    }
}