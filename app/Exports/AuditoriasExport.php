<?php

namespace App\Exports;

use App\Models\Audit;
use App\Models\Empleado;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class AuditoriasExport implements FromView
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Audit::query()->latest();

        // Usar el campo correcto para el ID del empleado
        if ($this->request->filled('empleado_id')) {
            $query->where('empleado_id', $this->request->empleado_id); // Corregido de 'user_id' a 'empleado_id'
        }

        // Filtro de fechas
        if ($this->request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $this->request->fecha_inicio);
        }

        if ($this->request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $this->request->fecha_fin);
        }

        $auditorias = $query->get();
        $empleados = Empleado::orderBy('nombres')->get();

        return view('auditorias.reporte_excel', compact('auditorias', 'empleados'));
    }
}