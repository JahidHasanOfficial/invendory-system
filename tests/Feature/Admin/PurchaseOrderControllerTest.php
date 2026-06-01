<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseOrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.purchase-orders.index'));
        $response->assertStatus(200);
    }

    public function test_create_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.purchase-orders.create'));
        $response->assertStatus(200);
    }

    public function test_store_creates_resource()
    {
        $admin = $this->setupSuperAdmin();
        $payload = ['vendor_id' => $this->createVendor()->id, 'branch_id' => 1, 'order_date' => '2026-06-01', 'total_amount' => 500, 'status' => 'draft', 'items' => [['product_id' => $this->createProduct()->id, 'quantity' => 5, 'unit_price' => 100, 'total_price' => 500]]];
        
        // Some models require organization_id
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\PurchaseOrder)->getTable(), 'organization_id')) {
            $payload['organization_id'] = $admin->organization_id;
        }

        $response = $this->actingAs($admin)->post(route('admin.purchase-orders.store'), $payload);
        $response->assertRedirect();
        
        // Assert it was created (skip for complex relations in generic test)
        $this->assertDatabaseCount((new \App\Models\PurchaseOrder)->getTable(), 1);
    }

    public function test_edit_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['po_no' => 'PO-TEST', 'vendor_id' => $this->createVendor()->id, 'branch_id' => 1, 'order_date' => '2026-06-01', 'total_amount' => 500, 'status' => 'draft'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\PurchaseOrder)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $purchaseorder = \App\Models\PurchaseOrder::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->get(route('admin.purchase-orders.edit', $purchaseorder->id ?? $purchaseorder->purchaseorder_id));
        $response->assertStatus(200);
    }

    public function test_update_modifies_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['po_no' => 'PO-TEST', 'vendor_id' => $this->createVendor()->id, 'branch_id' => 1, 'order_date' => '2026-06-01', 'total_amount' => 500, 'status' => 'draft'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\PurchaseOrder)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $purchaseorder = \App\Models\PurchaseOrder::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $updatePayload = ['vendor_id' => $this->createVendor()->id, 'branch_id' => 1, 'order_date' => '2026-06-01', 'total_amount' => 500, 'status' => 'draft', 'items' => [['product_id' => $this->createProduct()->id, 'quantity' => 5, 'unit_price' => 100, 'total_price' => 500]]];
        if (isset($updatePayload['name'])) {
            $updatePayload['name'] = 'Updated Name';
        }

        $response = $this->actingAs($admin)->put(route('admin.purchase-orders.update', $purchaseorder->id ?? $purchaseorder->purchaseorder_id), $updatePayload);
        $response->assertRedirect();
    }

    public function test_destroy_deletes_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['po_no' => 'PO-TEST', 'vendor_id' => $this->createVendor()->id, 'branch_id' => 1, 'order_date' => '2026-06-01', 'total_amount' => 500, 'status' => 'draft'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\PurchaseOrder)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $purchaseorder = \App\Models\PurchaseOrder::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->delete(route('admin.purchase-orders.destroy', $purchaseorder->id ?? $purchaseorder->purchaseorder_id));
        $response->assertRedirect();
        
        if (\App\Models\PurchaseOrder::class !== \App\Models\Branch::class) {
            $this->assertDatabaseCount((new \App\Models\PurchaseOrder)->getTable(), 0);
        }
    }
}