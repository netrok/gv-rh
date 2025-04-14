<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleadosExport;
use Barryvdh\DomPDF\Facade\Pdf;

class EmpleadoExportController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new EmpleadosExport, 'empleados.xlsx');
    }

    public function exportPdf()
    {
        $empleados = Empleado::all();
        $pdf = Pdf::loadView('empleados.pdf', compact('empleados'));
        return $pdf->download('empleados.pdf');
    }
}
