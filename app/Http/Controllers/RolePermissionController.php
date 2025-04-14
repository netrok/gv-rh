<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('roles.index', compact('roles', 'permissions'));
    }

    public function createRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    public function assignPermissions(Request $request, $roleId)
    {
        $role = Role::findById($roleId);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Permissions assigned successfully!');
    }

    public function assignRoleToUser(Request $request, $userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->assignRole($request->role);
            return redirect()->route('roles.index')->with('success', 'Role assigned to user!');
        }

        return redirect()->route('roles.index')->with('error', 'User not found!');
    }
}
