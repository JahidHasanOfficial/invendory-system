<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Desktop Computers (Uttara)
            ['id' => 'PC-UTT-001', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-001', 'barcode' => 'BAR-DELL-001', 'status' => 1],
            ['id' => 'PC-UTT-002', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-002', 'barcode' => 'BAR-DELL-002', 'status' => 1],
            ['id' => 'PC-UTT-003', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-003', 'barcode' => 'BAR-DELL-003', 'status' => 1],
            ['id' => 'PC-UTT-004', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-004', 'barcode' => 'BAR-DELL-004', 'status' => 1],
            ['id' => 'PC-UTT-005', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-005', 'barcode' => 'BAR-DELL-005', 'status' => 1],
            ['id' => 'PC-UTT-006', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-006', 'barcode' => 'BAR-DELL-006', 'status' => 1],
            ['id' => 'PC-UTT-007', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-007', 'barcode' => 'BAR-DELL-007', 'status' => 1],
            ['id' => 'PC-UTT-008', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-008', 'barcode' => 'BAR-DELL-008', 'status' => 1],
            ['id' => 'PC-UTT-009', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-009', 'barcode' => 'BAR-DELL-009', 'status' => 1],
            ['id' => 'PC-UTT-010', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-010', 'barcode' => 'BAR-DELL-010', 'status' => 1],
            
            // Gulshan Desktop
            ['id' => 'PC-GUL-001', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-011', 'barcode' => 'BAR-DELL-011', 'status' => 1],
            ['id' => 'PC-GUL-002', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-012', 'barcode' => 'BAR-DELL-012', 'status' => 1],
            
            // Chittagong Desktop
            ['id' => 'PC-CTG-001', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-013', 'barcode' => 'BAR-DELL-013', 'status' => 1],
            
            // Laptops
            ['id' => 'LAP-UTT-001', 'organization_id' => 1, 'category_id' => 7, 'brand_id' => 3, 'name' => 'Lenovo ThinkPad E14', 'purchase_price' => 75000, 'reorder_level' => 3, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'ThinkPad E14', 'sku' => 'SKU-LEN-001', 'barcode' => 'BAR-LEN-001', 'status' => 1],
            ['id' => 'LAP-UTT-002', 'organization_id' => 1, 'category_id' => 7, 'brand_id' => 3, 'name' => 'Lenovo ThinkPad E14', 'purchase_price' => 75000, 'reorder_level' => 3, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'ThinkPad E14', 'sku' => 'SKU-LEN-002', 'barcode' => 'BAR-LEN-002', 'status' => 1],
            ['id' => 'LAP-GUL-001', 'organization_id' => 1, 'category_id' => 7, 'brand_id' => 2, 'name' => 'HP Pavilion 15', 'purchase_price' => 68000, 'reorder_level' => 3, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Pavilion 15', 'sku' => 'SKU-HP-001', 'barcode' => 'BAR-HP-001', 'status' => 1],
            
            // Peripherals
            ['id' => 'MOUSE-01', 'organization_id' => 1, 'category_id' => 8, 'brand_id' => 4, 'name' => 'Logitech B100 Mouse', 'purchase_price' => 450, 'reorder_level' => 10, 'unit_id' => 1, 'is_serial_tracked' => false, 'is_asset' => false, 'model' => 'B100', 'sku' => 'SKU-LOG-M01', 'barcode' => 'BAR-LOG-M01', 'status' => 1],
            ['id' => 'KEY-01', 'organization_id' => 1, 'category_id' => 9, 'brand_id' => 1, 'name' => 'Dell KB216 Keyboard', 'purchase_price' => 800, 'reorder_level' => 8, 'unit_id' => 1, 'is_serial_tracked' => false, 'is_asset' => false, 'model' => 'KB216', 'sku' => 'SKU-DELL-K01', 'barcode' => 'BAR-DELL-K01', 'status' => 1],
            ['id' => 'MON-01', 'organization_id' => 1, 'category_id' => 10, 'brand_id' => 5, 'name' => 'Samsung 22" Monitor', 'purchase_price' => 12000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'LS22A', 'sku' => 'SKU-SAM-M01', 'barcode' => 'BAR-SAM-M01', 'status' => 1],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert(array_merge($product, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}