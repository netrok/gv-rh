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

// Rutas protegidas
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
        Route::get('empleados/exportar-pdf', [EmpleadoController::class, 'exportarPdf'])->name('empleados.exportarPdf');
    });

    // Puestos, Beneficiarios, Vacaciones, Sucursales
    Route::resources([
        'puestos' => PuestoController::class,
        'beneficiarios' => BeneficiarioController::class,
        'solicitudes-vacaciones' => SolicitudVacacionController::class,
        'sucursales' => SucursalController::class,
    ]);

    // Configuración (rol o permiso)
    Route::get('/configuracion', fn () => 'Configuración avanzada')->middleware('role_or_permission:admin|editar empleados');
});

// Página de inicio
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas de autenticación estándar de Laravel
Auth::routes();

Route::get('empleados/{id}/audits', [EmpleadoController::class, 'showAudits']);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
