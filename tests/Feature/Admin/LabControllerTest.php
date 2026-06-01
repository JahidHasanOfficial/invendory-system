<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.labs.index'));
        $response->assertStatus(200);
    }

    public function test_create_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.labs.create'));
        $response->assertStatus(200);
    }

    public function test_store_creates_resource()
    {
        $admin = $this->setupSuperAdmin();
        $payload = ['branch_id' => 1, 'name' => 'Test Lab', 'lab_code' => 'LAB-01', 'capacity' => 30, 'lab_type' => 'training_lab', 'status' => 1];
        
        // Some models require organization_id
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Lab)->getTable(), 'organization_id')) {
            $payload['organization_id'] = $admin->organization_id;
        }

        $response = $this->actingAs($admin)->post(route('admin.labs.store'), $payload);
        $response->assertRedirect();
        
        // Assert it was created (skip for complex relations in generic test)
        $this->assertDatabaseCount((new \App\Models\Lab)->getTable(), 1);
    }

    public function test_edit_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['branch_id' => 1, 'name' => 'Test Lab', 'lab_code' => 'LAB-01', 'capacity' => 30, 'lab_type' => 'training_lab', 'status' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Lab)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $lab = \App\Models\Lab::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->get(route('admin.labs.edit', $lab->id ?? $lab->lab_id));
        $response->assertStatus(200);
    }

    public function test_update_modifies_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['branch_id' => 1, 'name' => 'Test Lab', 'lab_code' => 'LAB-01', 'capacity' => 30, 'lab_type' => 'training_lab', 'status' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Lab)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $lab = \App\Models\Lab::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $updatePayload = ['branch_id' => 1, 'name' => 'Test Lab', 'lab_code' => 'LAB-01', 'capacity' => 30, 'lab_type' => 'training_lab', 'status' => 1];
        if (isset($updatePayload['name'])) {
            $updatePayload['name'] = 'Updated Name';
        }

        $response = $this->actingAs($admin)->put(route('admin.labs.update', $lab->id ?? $lab->lab_id), $updatePayload);
        $response->assertRedirect();
    }

    public function test_destroy_deletes_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['branch_id' => 1, 'name' => 'Test Lab', 'lab_code' => 'LAB-01', 'capacity' => 30, 'lab_type' => 'training_lab', 'status' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Lab)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $lab = \App\Models\Lab::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->delete(route('admin.labs.destroy', $lab->id ?? $lab->lab_id));
        $response->assertRedirect();
        
        if (\App\Models\Lab::class !== \App\Models\Branch::class) {
            $this->assertDatabaseCount((new \App\Models\Lab)->getTable(), 0);
        }
    }
}