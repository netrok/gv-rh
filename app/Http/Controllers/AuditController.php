<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AuditoriasExport;
use Barryvdh\DomPDF\Facade\Pdf;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $query = Audit::query()->with('empleado')->orderBy('created_at', 'desc');

        if ($request->filled('id_empleado')) {
            $query->where('id_empleado', $request->id_empleado);
        }

        if ($request->filled('desde')) {
            $query->whereDate('created_at', '>=', $request->desde);
        }

        if ($request->filled('hasta')) {
            $query->whereDate('created_at', '<=', $request->hasta);
        }

        $auditorias = $query->paginate(10)->withQueryString();
        $empleados = Empleado::orderBy('nombres')->get();

        return view('auditorias.index', compact('auditorias', 'empleados'));
    }

    public function export(Request $request)
    {
        return Excel::download(new AuditoriasExport($request), 'auditorias.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $auditorias = $this->filtrarAuditorias($request)->get();

        $pdf = Pdf::loadView('auditorias.reporte_pdf', compact('auditorias'));
        return $pdf->download('auditorias.pdf');
    }

    public function filtrarAuditorias(Request $request)
{
    $query = Audit::query()->latest(); // O cualquier filtro por defecto que necesites

    // Filtrado por empleado
    if ($request->filled('id_empleado')) {
        $query->where('id_empleado', $request->id_empleado);
    }

    // Filtrado por fecha de inicio
    if ($request->filled('fecha_inicio')) {
        $query->whereDate('created_at', '>=', $request->fecha_inicio);
    }

    // Filtrado por fecha de fin
    if ($request->filled('fecha_fin')) {
        $query->whereDate('created_at', '<=', $request->fecha_fin);
    }

    return $query;
}
}