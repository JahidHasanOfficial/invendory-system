<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [];

        foreach (Route::getRoutes()->getRoutes() as $route) {
            $middlewares = $route->middleware();
            if (!is_array($middlewares)) {
                continue;
            }

            foreach ($middlewares as $middleware) {
                if (is_string($middleware) && str_starts_with($middleware, 'permission:')) {
                    $permissionString = substr($middleware, 11);
                    $extracted = explode('|', $permissionString);
                    foreach ($extracted as $perm) {
                        if (!empty($perm) && !in_array($perm, $permissions)) {
                            $permissions[] = $perm;
                        }
                    }
                }
            }
        }

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }
    }
}
