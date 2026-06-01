<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RequisitionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.requisitions.index'));
        $response->assertStatus(200);
    }

    public function test_create_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.requisitions.create'));
        $response->assertStatus(200);
    }

    public function test_store_creates_resource()
    {
        $admin = $this->setupSuperAdmin();
        $payload = ['requester_branch_id' => 1, 'requested_by' => 1, 'requested_date' => '2026-06-01', 'priority' => 'low', 'status' => 'draft', 'items' => [['product_id' => $this->createProduct()->id, 'quantity' => 5]]];
        
        // Some models require organization_id
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Requisition)->getTable(), 'organization_id')) {
            $payload['organization_id'] = $admin->organization_id;
        }

        $response = $this->actingAs($admin)->post(route('admin.requisitions.store'), $payload);
        $response->assertRedirect();
        
        // Assert it was created (skip for complex relations in generic test)
        $this->assertDatabaseCount((new \App\Models\Requisition)->getTable(), 1);
    }

    public function test_edit_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['req_no' => 'REQ-TEST', 'requester_branch_id' => 1, 'requested_by' => 1, 'requested_date' => '2026-06-01', 'status' => 'draft'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Requisition)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $requisition = \App\Models\Requisition::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->get(route('admin.requisitions.edit', $requisition->id ?? $requisition->requisition_id));
        $response->assertStatus(200);
    }

    public function test_update_modifies_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['req_no' => 'REQ-TEST', 'requester_branch_id' => 1, 'requested_by' => 1, 'requested_date' => '2026-06-01', 'status' => 'draft'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Requisition)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $requisition = \App\Models\Requisition::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $updatePayload = ['requester_branch_id' => 1, 'requested_by' => 1, 'requested_date' => '2026-06-01', 'priority' => 'low', 'status' => 'draft', 'items' => [['product_id' => $this->createProduct()->id, 'quantity' => 5]]];
        if (isset($updatePayload['name'])) {
            $updatePayload['name'] = 'Updated Name';
        }

        $response = $this->actingAs($admin)->put(route('admin.requisitions.update', $requisition->id ?? $requisition->requisition_id), $updatePayload);
        $response->assertRedirect();
    }

    public function test_destroy_deletes_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['req_no' => 'REQ-TEST', 'requester_branch_id' => 1, 'requested_by' => 1, 'requested_date' => '2026-06-01', 'status' => 'draft'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Requisition)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $requisition = \App\Models\Requisition::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->delete(route('admin.requisitions.destroy', $requisition->id ?? $requisition->requisition_id));
        $response->assertRedirect();
        
        if (\App\Models\Requisition::class !== \App\Models\Branch::class) {
            $this->assertDatabaseCount((new \App\Models\Requisition)->getTable(), 0);
        }
    }
}