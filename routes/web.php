<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    Auth\LoginController,
    Auth\RegisterController,
    DashboardController,
    RolePermissionController,
    EmpleadoController,
    EmpleadoExportController,
    BeneficiarioController,
    PuestoController,
    SucursalController,
    AuditController,
    AsistenciaController,
    VacacionesController
};
use App\Exports\AsistenciasExport;
use App\Models\Asistencia;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

// -------------------- Página de Bienvenida --------------------
Route::get('/', fn() => view('welcome'));

// -------------------- Autenticación --------------------
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Auth::routes(); // Rutas por defecto

// -------------------- Público --------------------
Route::get('beneficiarios/{id}/pdf', [BeneficiarioController::class, 'generarPdf'])->name('beneficiarios.generarPdf');

// -------------------- Área Protegida --------------------
Route::middleware(['auth'])->group(function () {

    // ----------- Dashboard -----------
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ----------- Gestión de Roles y Permisos (solo admin) -----------
    Route::middleware('role:admin')->group(function () {
        Route::resource('roles', RolePermissionController::class)->except(['show', 'destroy']);
        Route::post('roles/{roleId}/permissions', [RolePermissionController::class, 'assignPermissions'])->name('roles.assignPermissions');
        Route::get('users/{userId}/assign-role', [RolePermissionController::class, 'showAssignRoleForm'])->name('roles.showAssignRoleForm');
        Route::post('users/{userId}/assign-role', [RolePermissionController::class, 'assignRoleToUser'])->name('roles.assignRoleToUser');
    });

    // ----------- Empleados (solo admin) -----------
    Route::middleware('role:admin')->group(function () {
        Route::resource('empleados', EmpleadoController::class)->except(['show']);
        Route::get('empleados/{id_empleado}/pdf', [EmpleadoController::class, 'generarPdf'])->name('empleados.pdf');
        Route::get('empleados/{id}/audits', [EmpleadoController::class, 'showAudits'])->name('empleados.audits');

        // Exportaciones
        Route::get('empleados/export/excel', [EmpleadoExportController::class, 'exportExcel'])->name('empleados.exportExcel');
        Route::get('empleados/export/pdf', [EmpleadoExportController::class, 'exportPdf'])->name('empleados.exportPdf');
        Route::get('empleados/exportar-pdf', [EmpleadoController::class, 'exportarPdf'])->name('empleados.exportarPdf');
    });

    // ----------- Vista individual de empleados (admin y empleado) -----------
    Route::middleware('role:admin|empleado')->get('empleados/{id_empleado}/show', [EmpleadoController::class, 'show'])->name('empleados.show');

    // ----------- Gestión de módulos administrativos (solo admin) -----------
    Route::middleware('role:admin')->group(function () {
        Route::resources([
            'puestos' => PuestoController::class,
            'beneficiarios' => BeneficiarioController::class,
            'vacaciones' => VacacionesController::class,
            'sucursales' => SucursalController::class,
        ]);

        // Exportaciones de sucursales
        Route::get('sucursales/export/excel', [SucursalController::class, 'exportExcel'])->name('sucursales.export.excel');
        Route::get('sucursales/export/pdf', [SucursalController::class, 'exportPDF'])->name('sucursales.export.pdf');

        // Actualización de sucursales
        Route::put('sucursales/{sucursal}', [SucursalController::class, 'update'])->name('sucursales.update');
    });

    // ----------- Configuración (con permisos) -----------
    Route::get('/configuracion', fn() => 'Configuración avanzada')
        ->middleware('role_or_permission:admin|editar empleados');

    // ----------- Auditorías (usuarios con permiso) -----------
    Route::middleware('can:ver auditorias')->group(function () {
        Route::get('/auditorias', [AuditController::class, 'index'])->name('auditorias.index');
        Route::get('/auditorias/export/excel', [AuditController::class, 'export'])->name('auditorias.export');
        Route::get('/auditorias/export/pdf', [AuditController::class, 'exportPdf'])->name('auditorias.export.pdf');
    });
});

// -------------------- Asistencias --------------------
Route::resource('asistencias', AsistenciaController::class);

// ----------- Exportaciones de Asistencias -----------
Route::prefix('asistencias/export')->group(function () {
    Route::get('excel', fn() => Excel::download(new AsistenciasExport, 'asistencias.xlsx'))->name('asistencias.export.excel');

    Route::get('pdf', function () {
        $asistencias = Asistencia::with('empleado')->get();
        $pdf = Pdf::loadView('asistencias.pdf', compact('asistencias'));
        return $pdf->download('asistencias.pdf');
    })->name('asistencias.export.pdf');

    Route::get('pdf-filtrado', function (Request $request) {
        $query = Asistencia::with('empleado');

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        $asistencias = $query->get();
        $pdf = Pdf::loadView('asistencias.pdf', compact('asistencias'));

        return $pdf->download('asistencias-filtrado.pdf');
    })->name('asistencias.export.pdf.filtrado');
});

// ----------- Reportes de Asistencia -----------
Route::get('/reporte-asistencia', [AsistenciaController::class, 'reporte'])->name('asistencias.reporte');
Route::get('/reporte-asistencia/pdf/{empleado}', [AsistenciaController::class, 'reportePdf'])->name('asistencias.reporte.pdf');

// ----------- Crear Vacaciones (solo admin, si corresponde) -----------
Route::get('/vacaciones/create', [VacacionesController::class, 'create'])->name('vacaciones.create');
Route::get('/vacaciones/{id}/edit', [VacacionesController::class, 'edit'])->name('vacaciones.edit');

