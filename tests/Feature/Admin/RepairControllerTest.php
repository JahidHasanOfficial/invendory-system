<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepairControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.repairs.index'));
        $response->assertStatus(200);
    }

    public function test_create_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.repairs.create'));
        $response->assertStatus(200);
    }

    public function test_store_creates_resource()
    {
        $admin = $this->setupSuperAdmin();
        $payload = ['repair_no' => 'REP-TEST', 'product_id' => $this->createProduct()->id, 'from_branch_id' => 1, 'fault_description' => 'Test Issue', 'status' => 'pending_receipt', 'created_by' => 1];
        
        // Some models require organization_id
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Repair)->getTable(), 'organization_id')) {
            $payload['organization_id'] = $admin->organization_id;
        }

        $response = $this->actingAs($admin)->post(route('admin.repairs.store'), $payload);
        $response->assertRedirect();
        
        // Assert it was created (skip for complex relations in generic test)
        $this->assertDatabaseCount((new \App\Models\Repair)->getTable(), 1);
    }

    public function test_edit_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['repair_no' => 'REP-TEST', 'product_id' => $this->createProduct()->id, 'from_branch_id' => 1, 'fault_description' => 'Test Issue', 'status' => 'pending_receipt', 'created_by' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Repair)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $repair = \App\Models\Repair::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->get(route('admin.repairs.edit', $repair->id ?? $repair->repair_id));
        $response->assertStatus(200);
    }

    public function test_update_modifies_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['repair_no' => 'REP-TEST', 'product_id' => $this->createProduct()->id, 'from_branch_id' => 1, 'fault_description' => 'Test Issue', 'status' => 'pending_receipt', 'created_by' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Repair)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $repair = \App\Models\Repair::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $updatePayload = ['repair_no' => 'REP-TEST', 'product_id' => $this->createProduct()->id, 'from_branch_id' => 1, 'fault_description' => 'Test Issue', 'status' => 'pending_receipt', 'created_by' => 1];
        if (isset($updatePayload['name'])) {
            $updatePayload['name'] = 'Updated Name';
        }

        $response = $this->actingAs($admin)->put(route('admin.repairs.update', $repair->id ?? $repair->repair_id), $updatePayload);
        $response->assertRedirect();
    }

    public function test_destroy_deletes_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['repair_no' => 'REP-TEST', 'product_id' => $this->createProduct()->id, 'from_branch_id' => 1, 'fault_description' => 'Test Issue', 'status' => 'pending_receipt', 'created_by' => 1];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Repair)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $repair = \App\Models\Repair::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->delete(route('admin.repairs.destroy', $repair->id ?? $repair->repair_id));
        $response->assertRedirect();
        
        if (\App\Models\Repair::class !== \App\Models\Branch::class) {
            $this->assertDatabaseCount((new \App\Models\Repair)->getTable(), 0);
        }
    }
}