<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Mostrar la vista para asignar permisos
    public function editPermissions($roleId)
    {
        $role = Role::findOrFail($roleId);  // Encuentra el rol por ID
        $permissions = Permission::all();  // Obtiene todos los permisos disponibles
        return view('roles.editPermissions', compact('role', 'permissions'));
    }

    // Guardar los permisos asignados a un rol
    public function updatePermissions(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);  // Encuentra el rol por ID
        $role->syncPermissions($request->permissions);  // Asigna los permisos seleccionados al rol

        return redirect()->route('roles.index')->with('success', 'Permisos actualizados con éxito');
    }
}