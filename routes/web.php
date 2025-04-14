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

Route::middleware(['auth'])->group(function () {
    Route::get('roles', [RolePermissionController::class, 'index'])->name('roles.index');
    Route::post('roles', [RolePermissionController::class, 'createRole']);
    Route::post('roles/{roleId}/permissions', [RolePermissionController::class, 'assignPermissions']);
    Route::post('users/{userId}/assign-role', [RolePermissionController::class, 'assignRoleToUser']);
});

Route::middleware('auth')->group(function() {
    // Ruta para editar permisos de un rol
    Route::get('roles/{roleId}/permissions', [RoleController::class, 'editPermissions'])->name('roles.editPermissions');
    // Ruta para actualizar los permisos de un rol
    Route::put('roles/{roleId}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.updatePermissions');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/prueba', function () {
        return '¡Hola Admin! Has accedido a una ruta protegida.';
    });
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Ruta solo para administradores
Route::get('/admin', function () {
    return 'Bienvenido al panel de administración';
})->middleware('role:admin');

// Ruta protegida por permiso
Route::get('/empleados', function () {
    return 'Lista de empleados (permiso requerido)';
})->middleware('permission:ver empleados');

// Ruta protegida por rol o permiso
Route::get('/configuracion', function () {
    return 'Configuración avanzada';
})->middleware('role_or_permission:admin|editar empleados');


Route::resource('puestos', PuestoController::class);

// Rutas para Beneficiarios
Route::get('beneficiarios', [BeneficiarioController::class, 'index'])->name('beneficiarios.index');
Route::get('beneficiarios/create', [BeneficiarioController::class, 'create'])->name('beneficiarios.create');
Route::post('beneficiarios', [BeneficiarioController::class, 'store'])->name('beneficiarios.store');
Route::get('beneficiarios/{id_beneficiario}/edit', [BeneficiarioController::class, 'edit'])->name('beneficiarios.edit');
Route::put('beneficiarios/{id_beneficiario}', [BeneficiarioController::class, 'update'])->name('beneficiarios.update');
Route::delete('beneficiarios/{id_beneficiario}', [BeneficiarioController::class, 'destroy'])->name('beneficiarios.destroy');

// Rutas para Empleados
Route::get('empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
Route::get('empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
Route::post('empleados', [EmpleadoController::class, 'store'])->name('empleados.store');
Route::get('empleados/{id_empleado}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');
Route::put('empleados/{id_empleado}', [EmpleadoController::class, 'update'])->name('empleados.update');
Route::delete('empleados/{id_empleado}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');
Route::get('/empleados/export/excel', [EmpleadoExportController::class, 'exportExcel'])->name('empleados.exportExcel');
Route::get('/empleados/export/pdf', [EmpleadoExportController::class, 'exportPdf'])->name('empleados.exportPdf');
Route::get('empleados/{id_empleado}', [EmpleadoController::class, 'show'])->name('empleados.show');
Route::get('empleados/{id_empleado}/pdf', [EmpleadoController::class, 'generatePdf'])->name('empleados.pdf');
Route::get('empleados/{id_empleado}', [EmpleadoController::class, 'show'])->name('empleados.show');
Route::get('empleados/{id_empleado}/pdf', [EmpleadoController::class, 'generarPdf'])->name('empleados.pdf');




// RUTAS PARA PUESTOS
Route::get('/puestos', [PuestoController::class, 'index'])->name('puestos.index'); // Listar todos
Route::get('/puestos/create', [PuestoController::class, 'create'])->name('puestos.create'); // Formulario de creación
Route::post('/puestos', [PuestoController::class, 'store'])->name('puestos.store'); // Guardar nuevo puesto
Route::get('/puestos/{id}', [PuestoController::class, 'show'])->name('puestos.show'); // Ver detalle de un puesto
Route::get('/puestos/{id}/edit', [PuestoController::class, 'edit'])->name('puestos.edit'); // Formulario de edición
Route::put('/puestos/{id}', [PuestoController::class, 'update'])->name('puestos.update'); // Actualizar un puesto
Route::delete('/puestos/{id}', [PuestoController::class, 'destroy'])->name('puestos.destroy'); // Eliminar un puesto

// RUTAS PARA SOLICITUDES DE VACACIONES
Route::get('/solicitudes-vacaciones', [SolicitudVacacionController::class, 'index'])->name('solicitudes-vacaciones.index');
Route::get('/solicitudes-vacaciones/create', [SolicitudVacacionController::class, 'create'])->name('solicitudes-vacaciones.create');
Route::post('/solicitudes-vacaciones', [SolicitudVacacionController::class, 'store'])->name('solicitudes-vacaciones.store');
Route::get('/solicitudes-vacaciones/{id}', [SolicitudVacacionController::class, 'show'])->name('solicitudes-vacaciones.show');
Route::get('/solicitudes-vacaciones/{id}/edit', [SolicitudVacacionController::class, 'edit'])->name('solicitudes-vacaciones.edit');
Route::put('/solicitudes-vacaciones/{id}', [SolicitudVacacionController::class, 'update'])->name('solicitudes-vacaciones.update');
Route::delete('/solicitudes-vacaciones/{id}', [SolicitudVacacionController::class, 'destroy'])->name('solicitudes-vacaciones.destroy');

// RUTAS PARA SUCURSALES
Route::get('/sucursales', [SucursalController::class, 'index'])->name('sucursales.index');
Route::get('/sucursales/create', [SucursalController::class, 'create'])->name('sucursales.create');
Route::post('/sucursales', [SucursalController::class, 'store'])->name('sucursales.store');
Route::get('/sucursales/{id}', [SucursalController::class, 'show'])->name('sucursales.show');
Route::get('/sucursales/{id}/edit', [SucursalController::class, 'edit'])->name('sucursales.edit');
Route::put('/sucursales/{id}', [SucursalController::class, 'update'])->name('sucursales.update');
Route::delete('/sucursales/{id}', [SucursalController::class, 'destroy'])->name('sucursales.destroy');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
