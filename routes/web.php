<?php

use App\Http\Controllers\BeneficiarioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\SolicitudVacacionController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\EmpleadoExportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RolePermissionController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // Rutas de gestión de roles y permisos
    Route::resource('roles', RolePermissionController::class)->except(['show', 'destroy']);
    Route::post('roles/{roleId}/permissions', [RolePermissionController::class, 'assignPermissions']);
    Route::post('users/{userId}/assign-role', [RolePermissionController::class, 'assignRoleToUser']);
    
    // Rutas para administradores
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', function () {
            return 'Bienvenido al panel de administración';
        });
        Route::get('/admin/prueba', function () {
            return '¡Hola Admin! Has accedido a una ruta protegida.';
        });
    });

    Route::middleware(['auth', 'permission:view-employees'])->get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');


    // Rutas para empleados
    Route::resource('empleados', EmpleadoController::class)->except('show');
    Route::get('empleados/{id_empleado}', [EmpleadoController::class, 'show'])->name('empleados.show');
    Route::get('empleados/{id_empleado}/pdf', [EmpleadoController::class, 'generatePdf'])->name('empleados.pdf');
    Route::get('/empleados/export/excel', [EmpleadoExportController::class, 'exportExcel'])->name('empleados.exportExcel');
    Route::get('/empleados/export/pdf', [EmpleadoExportController::class, 'exportPdf'])->name('empleados.exportPdf');

    // Rutas para puestos
    Route::resource('puestos', PuestoController::class);

    // Rutas para beneficiarios
    Route::resource('beneficiarios', BeneficiarioController::class);

    // Rutas para solicitudes de vacaciones
    Route::resource('solicitudes-vacaciones', SolicitudVacacionController::class);

    // Rutas para sucursales
    Route::resource('sucursales', SucursalController::class);
});

// Rutas de prueba protegidas por permisos
Route::get('/empleados', function () {
    return 'Lista de empleados (permiso requerido)';
})->middleware('permission:ver empleados');

// Rutas protegidas por rol o permiso
Route::get('/configuracion', function () {
    return 'Configuración avanzada';
})->middleware('role_or_permission:admin|editar empleados');

// Rutas de autenticación por defecto
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('roles', [RolePermissionController::class, 'index'])->name('roles.index');
    Route::post('roles', [RolePermissionController::class, 'createRole']);
    Route::post('roles/{roleId}/permissions', [RolePermissionController::class, 'assignPermissions'])->name('roles.assignPermissions');
    Route::post('users/{userId}/assign-role', [RolePermissionController::class, 'assignRoleToUser']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('users/{userId}/assign-role', [RolePermissionController::class, 'showAssignRoleForm'])->name('roles.showAssignRoleForm');
    Route::post('users/{userId}/assign-role', [RolePermissionController::class, 'assignRoleToUser'])->name('roles.assignRoleToUser');
});

// Rutas para Administradores
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
    Route::get('/empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
    Route::post('/empleados', [EmpleadoController::class, 'store'])->name('empleados.store');
    Route::get('/empleados/{id_empleado}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');
    Route::put('/empleados/{id_empleado}', [EmpleadoController::class, 'update'])->name('empleados.update');
    Route::delete('/empleados/{id_empleado}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');
    Route::get('/empleados/{id_empleado}/show', [EmpleadoController::class, 'show'])->name('empleados.show');
    Route::get('/empleados/export/excel', [EmpleadoController::class, 'exportExcel'])->name('empleados.exportExcel');
    Route::get('/empleados/export/pdf', [EmpleadoController::class, 'exportPDF'])->name('empleados.exportPdf');
});

// Rutas para Empleados
Route::middleware(['auth', 'role:empleado'])->group(function () {
    Route::get('/empleados/{id_empleado}/show', [EmpleadoController::class, 'show'])->name('empleados.show');
});