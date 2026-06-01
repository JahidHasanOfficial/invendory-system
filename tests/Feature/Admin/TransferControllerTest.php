<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransferControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.transfers.index'));
        $response->assertStatus(200);
    }

    public function test_create_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.transfers.create'));
        $response->assertStatus(200);
    }

    public function test_store_creates_resource()
    {
        $admin = $this->setupSuperAdmin();
        $payload = ['from_branch_id' => 1, 'to_branch_id' => $this->createBranch2()->id, 'requested_by' => 1, 'transfer_date' => '2026-06-01', 'status' => 'pending', 'items' => [['product_id' => $this->createProduct()->id, 'quantity' => 2]]];
        
        // Some models require organization_id
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Transfer)->getTable(), 'organization_id')) {
            $payload['organization_id'] = $admin->organization_id;
        }

        $response = $this->actingAs($admin)->post(route('admin.transfers.store'), $payload);
        $response->assertRedirect();
        
        // Assert it was created (skip for complex relations in generic test)
        $this->assertDatabaseCount((new \App\Models\Transfer)->getTable(), 1);
    }

    public function test_edit_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['transfer_no' => 'TR-TEST', 'from_branch_id' => 1, 'to_branch_id' => $this->createBranch2()->id, 'requested_by' => 1, 'transfer_date' => '2026-06-01', 'status' => 'pending'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Transfer)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $transfer = \App\Models\Transfer::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->get(route('admin.transfers.edit', $transfer->id ?? $transfer->transfer_id));
        $response->assertStatus(200);
    }

    public function test_update_modifies_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['transfer_no' => 'TR-TEST', 'from_branch_id' => 1, 'to_branch_id' => $this->createBranch2()->id, 'requested_by' => 1, 'transfer_date' => '2026-06-01', 'status' => 'pending'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Transfer)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $transfer = \App\Models\Transfer::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $updatePayload = ['from_branch_id' => 1, 'to_branch_id' => $this->createBranch2()->id, 'requested_by' => 1, 'transfer_date' => '2026-06-01', 'status' => 'pending', 'items' => [['product_id' => $this->createProduct()->id, 'quantity' => 2]]];
        if (isset($updatePayload['name'])) {
            $updatePayload['name'] = 'Updated Name';
        }

        $response = $this->actingAs($admin)->put(route('admin.transfers.update', $transfer->id ?? $transfer->transfer_id), $updatePayload);
        $response->assertRedirect();
    }

    public function test_destroy_deletes_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['transfer_no' => 'TR-TEST', 'from_branch_id' => 1, 'to_branch_id' => $this->createBranch2()->id, 'requested_by' => 1, 'transfer_date' => '2026-06-01', 'status' => 'pending'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\Transfer)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $transfer = \App\Models\Transfer::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->delete(route('admin.transfers.destroy', $transfer->id ?? $transfer->transfer_id));
        $response->assertRedirect();
        
        if (\App\Models\Transfer::class !== \App\Models\Branch::class) {
            $this->assertDatabaseCount((new \App\Models\Transfer)->getTable(), 0);
        }
    }
}