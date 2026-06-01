<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setupSuperAdmin()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        $org = \App\Models\Organization::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Default Organization',
                'email' => 'org@example.com',
                'phone' => '1234567890',
                'address' => 'Test Address'
            ]
        );

        $branch = \App\Models\Branch::firstOrCreate(
            ['id' => 1],
            [
                'organization_id' => $org->id,
                'name' => 'Main Branch',
                'code' => 'MB-01',
                'status' => 1
            ]
        );

        $admin = \App\Models\User::factory()->create([
            'organization_id' => $org->id,
            'branch_id' => $branch->id
        ]);
        
        $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $admin->assignRole($role);

        \Illuminate\Database\Eloquent\Model::reguard();

        return $admin;
    }

    protected function createBranch2()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        $branch = \App\Models\Branch::firstOrCreate(
            ['id' => 2],
            [
                'organization_id' => 1,
                'name' => 'Branch 2',
                'code' => 'BR-02',
                'status' => 1
            ]
        );
        \Illuminate\Database\Eloquent\Model::reguard();
        return $branch;
    }

    protected function createBrand()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        $brand = \App\Models\Brand::firstOrCreate(['id' => 1], ['name' => 'Test Brand', 'status' => 1, 'organization_id' => 1]);
        \Illuminate\Database\Eloquent\Model::reguard();
        return $brand;
    }

    protected function createCategory()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        $cat = \App\Models\ProductCategory::firstOrCreate(['id' => 1], ['name' => 'Test Category', 'status' => 1, 'organization_id' => 1]);
        \Illuminate\Database\Eloquent\Model::reguard();
        return $cat;
    }

    protected function createUnit()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        $unit = \App\Models\Unit::firstOrCreate(['id' => 1], ['short_name' => 'pcs', 'full_name' => 'Pieces', 'status' => 1, 'organization_id' => 1]);
        \Illuminate\Database\Eloquent\Model::reguard();
        return $unit;
    }

    protected function createProduct()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        $product = \App\Models\Product::firstOrCreate(
            ['id' => 'PRD-TEST01'], 
            ['name' => 'Test Product', 'brand_id' => $this->createBrand()->id, 'category_id' => $this->createCategory()->id, 'unit_id' => $this->createUnit()->id, 'status' => 1, 'organization_id' => 1]
        );
        \Illuminate\Database\Eloquent\Model::reguard();
        return $product;
    }

    protected function createLab()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        $lab = \App\Models\Lab::firstOrCreate(['id' => 1], ['branch_id' => 1, 'name' => 'Test Lab', 'lab_code' => 'LAB-01', 'status' => 1]);
        \Illuminate\Database\Eloquent\Model::reguard();
        return $lab;
    }

    protected function createVendor()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        $vendor = \App\Models\Vendor::firstOrCreate(['id' => 1], ['name' => 'Test Vendor', 'status' => 1, 'organization_id' => 1]);
        \Illuminate\Database\Eloquent\Model::reguard();
        return $vendor;
    }

    protected function createPO()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        $po = \App\Models\PurchaseOrder::firstOrCreate(['id' => 1], ['po_no' => 'PO-1', 'vendor_id' => $this->createVendor()->id, 'branch_id' => 1, 'order_date' => '2026-06-01', 'total_amount' => 500, 'organization_id' => 1, 'status' => 'draft']);
        \Illuminate\Database\Eloquent\Model::reguard();
        return $po;
    }

    protected function createAsset()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        $asset = \App\Models\AssetAssignment::firstOrCreate(['id' => 1], ['product_id' => $this->createProduct()->id, 'serial_no' => 'SN-123', 'branch_id' => 1, 'assigned_to_user_id' => 1, 'assigned_by' => 1, 'assigned_date' => '2026-06-01', 'assignment_type' => 'permanent', 'condition' => 'good', 'status' => 'assigned', 'organization_id' => 1]);
        \Illuminate\Database\Eloquent\Model::reguard();
        return $asset;
    }
}
