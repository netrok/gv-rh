<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BeneficiarioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpleadoExportController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SolicitudVacacionController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', fn () => view('welcome'));

// Autenticación
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Rutas protegidas (requiere autenticación)
Route::middleware(['auth'])->group(function () {

    // Roles y permisos
    Route::resource('roles', RolePermissionController::class)->except(['show', 'destroy']);
    Route::post('roles/{roleId}/permissions', [RolePermissionController::class, 'assignPermissions'])->name('roles.assignPermissions');
    Route::post('users/{userId}/assign-role', [RolePermissionController::class, 'assignRoleToUser'])->name('roles.assignRoleToUser');
    Route::get('users/{userId}/assign-role', [RolePermissionController::class, 'showAssignRoleForm'])->name('roles.showAssignRoleForm');

    // Empleados - accesible para admin y empleado (solo ver)
    Route::middleware(['role:admin|empleado'])->group(function () {
        Route::get('empleados/{id_empleado}/show', [EmpleadoController::class, 'show'])->name('empleados.show');
    });

    // Empleados - solo admin (gestión completa)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('empleados', EmpleadoController::class)->except(['show']);
        Route::get('empleados/{id_empleado}/pdf', [EmpleadoController::class, 'generarPdf'])->name('empleados.pdf');
        Route::get('empleados/export/excel', [EmpleadoExportController::class, 'exportExcel'])->name('empleados.exportExcel');
        Route::get('empleados/export/pdf', [EmpleadoExportController::class, 'exportPdf'])->name('empleados.exportPdf');
    });

    // Puestos, Beneficiarios, Vacaciones, Sucursales
    Route::resources([
        'puestos' => PuestoController::class,
        'beneficiarios' => BeneficiarioController::class,
        'solicitudes-vacaciones' => SolicitudVacacionController::class,
        'sucursales' => SucursalController::class,
    ]);

    // Configuración avanzada (rol o permiso)
    Route::get('/configuracion', fn () => 'Configuración avanzada')->middleware('role_or_permission:admin|editar empleados');
});

// Página de inicio (Dashboard)
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// Rutas de autenticación estándar de Laravel
Auth::routes();

// Rutas adicionales para auditoría de empleados
Route::get('empleados/{id}/audits', [EmpleadoController::class, 'showAudits']);

// Dashboard (requiere estar autenticado)
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rutas para exportar sucursales (excel, pdf)
Route::get('sucursales/export/excel', [SucursalController::class, 'exportExcel'])->name('sucursales.export.excel');
Route::get('sucursales/export/pdf', [SucursalController::class, 'exportPDF'])->name('sucursales.export.pdf');

// Corregimos la ruta de recurso para sucursales (usamos el nombre correcto del parámetro)
Route::resource('sucursales', SucursalController::class)->middleware('auth')->parameters([
    'sucursales' => 'sucursal'  // Aseguramos que Laravel use 'sucursal' como nombre del parámetro
]);

Route::put('/sucursales/{sucursal}', [SucursalController::class, 'update'])->name('sucursales.update');