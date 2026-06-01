<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.roles.index'));
        $response->assertStatus(200);
    }

    public function test_store_creates_resource()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->post(route('admin.roles.store'), [
            'name' => 'test_role',
            'permissions' => []
        ]);
        
        $response->assertRedirect(route('admin.roles.index'));
        $this->assertDatabaseHas('roles', ['name' => 'test_role']);
    }

    public function test_update_modifies_resource()
    {
        $admin = $this->setupSuperAdmin();
        $role = Role::create(['name' => 'old_role', 'guard_name' => 'web']);
        
        $response = $this->actingAs($admin)->put(route('admin.roles.update', $role->id), [
            'name' => 'new_role',
            'permissions' => []
        ]);
        
        $response->assertRedirect(route('admin.roles.index'));
        $this->assertDatabaseHas('roles', ['name' => 'new_role']);
    }

    public function test_destroy_deletes_resource()
    {
        $admin = $this->setupSuperAdmin();
        $role = Role::create(['name' => 'role_to_delete', 'guard_name' => 'web']);
        
        $response = $this->actingAs($admin)->delete(route('admin.roles.destroy', $role->id));
        
        $response->assertRedirect(route('admin.roles.index'));
        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
    }
}
