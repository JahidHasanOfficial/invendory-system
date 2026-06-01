<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GoodsReceiptControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.goods-receipts.index'));
        $response->assertStatus(200);
    }

    public function test_create_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        $response = $this->actingAs($admin)->get(route('admin.goods-receipts.create'));
        $response->assertStatus(200);
    }

    public function test_store_creates_resource()
    {
        $admin = $this->setupSuperAdmin();
        $payload = ['po_id' => $this->createPO()->id, 'branch_id' => 1, 'received_date' => '2026-06-01', 'status' => 'pending', 'items' => [['product_id' => $this->createProduct()->id, 'received_qty' => 5, 'unit_price' => 100, 'total_price' => 500]]];
        
        // Some models require organization_id
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\GoodsReceipt)->getTable(), 'organization_id')) {
            $payload['organization_id'] = $admin->organization_id;
        }

        $response = $this->actingAs($admin)->post(route('admin.goods-receipts.store'), $payload);
        $response->assertRedirect();
        
        // Assert it was created (skip for complex relations in generic test)
        $this->assertDatabaseCount((new \App\Models\GoodsReceipt)->getTable(), 1);
    }

    public function test_edit_renders_successfully()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['gr_no' => 'GR-TEST', 'po_id' => $this->createPO()->id, 'branch_id' => 1, 'received_date' => '2026-06-01', 'received_by' => 1, 'status' => 'pending'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\GoodsReceipt)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $goodsreceipt = \App\Models\GoodsReceipt::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->get(route('admin.goods-receipts.edit', $goodsreceipt->id ?? $goodsreceipt->goodsreceipt_id));
        $response->assertStatus(200);
    }

    public function test_update_modifies_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['gr_no' => 'GR-TEST', 'po_id' => $this->createPO()->id, 'branch_id' => 1, 'received_date' => '2026-06-01', 'received_by' => 1, 'status' => 'pending'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\GoodsReceipt)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $goodsreceipt = \App\Models\GoodsReceipt::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $updatePayload = ['po_id' => $this->createPO()->id, 'branch_id' => 1, 'received_date' => '2026-06-01', 'status' => 'pending', 'items' => [['product_id' => $this->createProduct()->id, 'received_qty' => 5, 'unit_price' => 100, 'total_price' => 500]]];
        if (isset($updatePayload['name'])) {
            $updatePayload['name'] = 'Updated Name';
        }

        $response = $this->actingAs($admin)->put(route('admin.goods-receipts.update', $goodsreceipt->id ?? $goodsreceipt->goodsreceipt_id), $updatePayload);
        $response->assertRedirect();
    }

    public function test_destroy_deletes_resource()
    {
        $admin = $this->setupSuperAdmin();
        
        \Illuminate\Database\Eloquent\Model::unguard();
        $createData = ['gr_no' => 'GR-TEST', 'po_id' => $this->createPO()->id, 'branch_id' => 1, 'received_date' => '2026-06-01', 'received_by' => 1, 'status' => 'pending'];
        if (\Illuminate\Support\Facades\Schema::hasColumn((new \App\Models\GoodsReceipt)->getTable(), 'organization_id')) {
            $createData['organization_id'] = $admin->organization_id;
        }
        $goodsreceipt = \App\Models\GoodsReceipt::create($createData);
        \Illuminate\Database\Eloquent\Model::reguard();

        $response = $this->actingAs($admin)->delete(route('admin.goods-receipts.destroy', $goodsreceipt->id ?? $goodsreceipt->goodsreceipt_id));
        $response->assertRedirect();
        
        if (\App\Models\GoodsReceipt::class !== \App\Models\Branch::class) {
            $this->assertDatabaseCount((new \App\Models\GoodsReceipt)->getTable(), 0);
        }
    }
}