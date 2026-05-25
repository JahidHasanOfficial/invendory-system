<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'branch_staff',
            'branch_manager',
            'store_keeper',
            'inventory_manager',
            'hr_admin',
            'cfo',
            'md'
        ];

        foreach ($roles as $role) {
            Role::findOrCreate($role);
        }
    }
}