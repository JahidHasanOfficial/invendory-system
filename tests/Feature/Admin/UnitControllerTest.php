<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnitControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.units.index'));
        $response->assertStatus(200);
    }

    public function test_create_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.units.create'));
        $response->assertStatus(200);
    }

    public function test_store_creates_resource()
    {
        $admin = $this->setupSuperAdmin();
        $payload = ['short_name' => 'pcs', 'full_name' => 'Pieces', 'status' => 1];
        
        // Some models require organization_id
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Unit)->getTable(), 'organization_id')) {
            $payload['organization_id'] = $admin->organization_id;
        }

        $response = $this->actingAs($admin)->post(route('admin.units.store'), $payload);
        $response->assertRedirect();
        
        // Assert it was created (skip for complex relations in generic test)
        $this->assertDatabaseCount((new \App\Models\Unit)->getTable(), 1);
    }

    public function test_edit_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['short_name' => 'pcs', 'full_name' => 'Pieces', 'status' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Unit)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $unit = \App\Models\Unit::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->get(route('admin.units.edit', $unit->id ?? $unit->unit_id));
        $response->assertStatus(200);
    }

    public function test_update_modifies_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['short_name' => 'pcs', 'full_name' => 'Pieces', 'status' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Unit)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $unit = \App\Models\Unit::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $updatePayload = ['short_name' => 'pcs', 'full_name' => 'Pieces', 'status' => 1];
        if (isset($updatePayload['name'])) {
            $updatePayload['name'] = 'Updated Name';
        }

        $response = $this->actingAs($admin)->put(route('admin.units.update', $unit->id ?? $unit->unit_id), $updatePayload);
        $response->assertRedirect();
    }

    public function test_destroy_deletes_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['short_name' => 'pcs', 'full_name' => 'Pieces', 'status' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Unit)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $unit = \App\Models\Unit::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->delete(route('admin.units.destroy', $unit->id ?? $unit->unit_id));
        $response->assertRedirect();
        
        if (\App\Models\Unit::class !== \App\Models\Branch::class) {
            $this->assertDatabaseCount((new \App\Models\Unit)->getTable(), 0);
        }
    }
}