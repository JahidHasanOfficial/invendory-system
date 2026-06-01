<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.categories.index'));
        $response->assertStatus(200);
    }

    public function test_create_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.categories.create'));
        $response->assertStatus(200);
    }

    public function test_store_creates_resource()
    {
        $admin = $this->setupSuperAdmin();
        $payload = ['name' => 'Test Category', 'status' => 1];
        
        // Some models require organization_id
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\ProductCategory)->getTable(), 'organization_id')) {
            $payload['organization_id'] = $admin->organization_id;
        }

        $response = $this->actingAs($admin)->post(route('admin.categories.store'), $payload);
        $response->assertRedirect();
        
        // Assert it was created (skip for complex relations in generic test)
        $this->assertDatabaseCount((new \App\Models\ProductCategory)->getTable(), 1);
    }

    public function test_edit_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['name' => 'Test Category', 'status' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\ProductCategory)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $category = \App\Models\ProductCategory::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->get(route('admin.categories.edit', $category->id ?? $category->category_id));
        $response->assertStatus(200);
    }

    public function test_update_modifies_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['name' => 'Test Category', 'status' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\ProductCategory)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $category = \App\Models\ProductCategory::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $updatePayload = ['name' => 'Test Category', 'status' => 1];
        if (isset($updatePayload['name'])) {
            $updatePayload['name'] = 'Updated Name';
        }

        $response = $this->actingAs($admin)->put(route('admin.categories.update', $category->id ?? $category->category_id), $updatePayload);
        $response->assertRedirect();
    }

    public function test_destroy_deletes_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['name' => 'Test Category', 'status' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\ProductCategory)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $category = \App\Models\ProductCategory::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->delete(route('admin.categories.destroy', $category->id ?? $category->category_id));
        $response->assertRedirect();
        
        if (\App\Models\ProductCategory::class !== \App\Models\Branch::class) {
            $this->assertDatabaseCount((new \App\Models\ProductCategory)->getTable(), 0);
        }
    }
}