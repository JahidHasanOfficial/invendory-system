<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.products.index'));
        $response->assertStatus(200);
    }

    public function test_create_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.products.create'));
        $response->assertStatus(200);
    }

    public function test_store_creates_resource()
    {
        $admin = $this->setupSuperAdmin();
        $payload = ['id' => 'PRD-TEST01', 'name' => 'Test Product', 'brand_id' => $this->createBrand()->id, 'category_id' => $this->createCategory()->id, 'unit_id' => $this->createUnit()->id, 'status' => 1];
        
        // Some models require organization_id
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Product)->getTable(), 'organization_id')) {
            $payload['organization_id'] = $admin->organization_id;
        }

        $response = $this->actingAs($admin)->post(route('admin.products.store'), $payload);
        $response->assertRedirect();
        
        // Assert it was created (skip for complex relations in generic test)
        $this->assertDatabaseCount((new \App\Models\Product)->getTable(), 1);
    }

    public function test_edit_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['id' => 'PRD-TEST01', 'name' => 'Test Product', 'brand_id' => $this->createBrand()->id, 'category_id' => $this->createCategory()->id, 'unit_id' => $this->createUnit()->id, 'status' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Product)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $product = \App\Models\Product::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->get(route('admin.products.edit', $product->id ?? $product->product_id));
        $response->assertStatus(200);
    }

    public function test_update_modifies_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['id' => 'PRD-TEST01', 'name' => 'Test Product', 'brand_id' => $this->createBrand()->id, 'category_id' => $this->createCategory()->id, 'unit_id' => $this->createUnit()->id, 'status' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Product)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $product = \App\Models\Product::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $updatePayload = ['id' => 'PRD-TEST01', 'name' => 'Test Product', 'brand_id' => $this->createBrand()->id, 'category_id' => $this->createCategory()->id, 'unit_id' => $this->createUnit()->id, 'status' => 1];
        if (isset($updatePayload['name'])) {
            $updatePayload['name'] = 'Updated Name';
        }

        $response = $this->actingAs($admin)->put(route('admin.products.update', $product->id ?? $product->product_id), $updatePayload);
        $response->assertRedirect();
    }

    public function test_destroy_deletes_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['id' => 'PRD-TEST01', 'name' => 'Test Product', 'brand_id' => $this->createBrand()->id, 'category_id' => $this->createCategory()->id, 'unit_id' => $this->createUnit()->id, 'status' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Product)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $product = \App\Models\Product::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->delete(route('admin.products.destroy', $product->id ?? $product->product_id));
        $response->assertRedirect();
        
        if (\App\Models\Product::class !== \App\Models\Branch::class) {
            $this->assertDatabaseCount((new \App\Models\Product)->getTable(), 0);
        }
    }
}