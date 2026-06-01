<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Services\RolePermissionService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected RolePermissionService $rolePermissionService;

    public function __construct(RolePermissionService $rolePermissionService)
    {
        $this->rolePermissionService = $rolePermissionService;
    }

    public function index()
    {
        $roles = $this->rolePermissionService->getAllRoles();
        $groupedPermissions = $this->rolePermissionService->getGroupedPermissions();
        return view('admin.roles.index', compact('roles', 'groupedPermissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        Role::create(['name' => $request->name]);
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update(['name' => $request->name]);

        // Assign permissions
        $permissions = $request->input('permissions', []);
        $this->rolePermissionService->assignPermissionsToRole($role, $permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'super-admin') {
            return redirect()->route('admin.roles.index')->with('error', 'Cannot delete super-admin role.');
        }
        
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}
