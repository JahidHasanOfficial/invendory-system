<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Collection;

class RolePermissionService
{
    /**
     * Get all roles.
     */
    public function getAllRoles()
    {
        return Role::with('permissions')->orderBy('name')->get();
    }

    /**
     * Get grouped permissions for the UI.
     * Expects permission names like 'create-brands', 'edit-hero-sections'.
     */
    public function getGroupedPermissions(): Collection
    {
        $permissions = Permission::orderBy('name')->get();
        $grouped = collect();

        foreach ($permissions as $permission) {
            $name = $permission->name;
            $moduleName = 'General';
            
            if (str_contains($name, '.')) {
                // Handle dot notation: brands.create -> Module: Brands, Action: create
                $parts = explode('.', $name);
                $moduleName = $parts[0];
            } elseif (str_contains($name, '-')) {
                // Handle dash notation: create-brands -> Module: Brands, Action: create
                $parts = explode('-', $name);
                $moduleName = count($parts) > 1 ? implode('-', array_slice($parts, 1)) : 'General';
            }

            // Make it Title Case for display (e.g., 'Hero-Sections' or 'Brands')
            $displayModule = collect(explode('-', str_replace('_', '-', $moduleName)))
                            ->map(fn($word) => ucfirst($word))
                            ->implode('-');

            if (!$grouped->has($displayModule)) {
                $grouped->put($displayModule, collect());
            }

            $grouped[$displayModule]->push($permission);
        }

        // Sort by module name
        return $grouped->sortKeys();
    }

    /**
     * Assign permissions to a role.
     */
    public function assignPermissionsToRole(Role $role, array $permissionIds): void
    {
        $permissions = Permission::whereIn('id', $permissionIds)->get();
        $role->syncPermissions($permissions);
    }
}
