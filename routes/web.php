<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpleadoExportController;
use App\Http\Controllers\BeneficiarioController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\SolicitudVacacionController;
use App\Http\Controllers\AuditController;

// ------------------- Página de bienvenida -------------------
Route::get('/', fn() => view('welcome'));

// ------------------- Autenticación -------------------
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Auth::routes(); // Rutas por defecto de Laravel

// ------------------- Acceso público -------------------
Route::get('beneficiarios/{id}/pdf', [BeneficiarioController::class, 'generarPdf'])->name('beneficiarios.generarPdf');

// ------------------- Área Protegida -------------------
Route::middleware(['auth'])->group(function () {

    // ----------- Dashboard -----------
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ----------- Roles y Permisos (solo admin) -----------
    Route::middleware('role:admin')->group(function () {
        Route::resource('roles', RolePermissionController::class)->except(['show', 'destroy']);
        Route::post('roles/{roleId}/permissions', [RolePermissionController::class, 'assignPermissions'])->name('roles.assignPermissions');
        Route::get('users/{userId}/assign-role', [RolePermissionController::class, 'showAssignRoleForm'])->name('roles.showAssignRoleForm');
        Route::post('users/{userId}/assign-role', [RolePermissionController::class, 'assignRoleToUser'])->name('roles.assignRoleToUser');
    });

    // ----------- Empleados -----------
    Route::middleware('role:admin')->group(function () {
        Route::resource('empleados', EmpleadoController::class)->except(['show']);
        Route::get('empleados/{id_empleado}/pdf', [EmpleadoController::class, 'generarPdf'])->name('empleados.pdf');
        Route::get('empleados/{id}/audits', [EmpleadoController::class, 'showAudits'])->name('empleados.audits');

        // Exportaciones
        Route::get('empleados/export/excel', [EmpleadoExportController::class, 'exportExcel'])->name('empleados.exportExcel');
        Route::get('empleados/export/pdf', [EmpleadoExportController::class, 'exportPdf'])->name('empleados.exportPdf');
        Route::get('empleados/exportar-pdf', [EmpleadoController::class, 'exportarPdf'])->name('empleados.exportarPdf');
    });

    // Visualización individual (admin y empleado)
    Route::middleware('role:admin|empleado')->group(function () {
        Route::get('empleados/{id_empleado}/show', [EmpleadoController::class, 'show'])->name('empleados.show');
    });

    // ----------- Módulos de Gestión (solo admin) -----------
    Route::middleware('role:admin')->group(function () {
        Route::resources([
            'puestos' => PuestoController::class,
            'beneficiarios' => BeneficiarioController::class,
            'solicitudes-vacaciones' => SolicitudVacacionController::class,
            'sucursales' => SucursalController::class,
        ]);

        // Exportaciones de sucursales
        Route::get('sucursales/export/excel', [SucursalController::class, 'exportExcel'])->name('sucursales.export.excel');
        Route::get('sucursales/export/pdf', [SucursalController::class, 'exportPDF'])->name('sucursales.export.pdf');

        // Actualización explícita de sucursales
        Route::put('sucursales/{sucursal}', [SucursalController::class, 'update'])->name('sucursales.update');
    });

    // ----------- Configuración avanzada -----------
    Route::get('/configuracion', fn() => 'Configuración avanzada')
        ->middleware('role_or_permission:admin|editar empleados');

    // ----------- Auditorías (usuarios con permiso) -----------
    Route::middleware('can:ver auditorias')->group(function () {
        Route::get('/auditorias', [AuditController::class, 'index'])->name('auditorias.index');
        Route::get('/auditorias/export/excel', [AuditController::class, 'export'])->name('auditorias.export');
        Route::get('/auditorias/export/pdf', [AuditController::class, 'exportPdf'])->name('auditorias.export.pdf');
    });
});