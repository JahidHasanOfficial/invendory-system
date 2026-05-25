<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            OrganizationSeeder::class,
            BranchSeeder::class,
            UserSeeder::class,
            ProductCategorySeeder::class,
            BrandSeeder::class,
            UnitSeeder::class,
            ProductSeeder::class,
            VendorSeeder::class,
            VoucherTypeSeeder::class,
            LabSeeder::class,
            WorkstationSeeder::class,
            CurrentStockSeeder::class,
            LabStockItemSeeder::class,
            AssetAssignmentSeeder::class,
            SettingSeeder::class,
            RequisitionSeeder::class,
            PurchaseOrderSeeder::class,
            GoodsReceiptSeeder::class,
            StockMovementSeeder::class,
        ]);
    }
}