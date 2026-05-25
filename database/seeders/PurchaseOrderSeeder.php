<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseOrderSeeder extends Seeder
{
    public function run(): void
    {
        // Insert purchase order
        DB::table('purchase_orders')->insert([
            'organization_id' => 1,
            'po_no' => 'PO-2026-0001',
            'vendor_id' => 1,
            'branch_id' => 1,
            'order_date' => '2026-05-21',
            'expected_delivery_date' => '2026-05-28',
            'subtotal' => 17000,
            'tax_amount' => 0,
            'shipping_cost' => 200,
            'total_amount' => 17200,
            'status' => 'received',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Insert purchase order items
        DB::table('purchase_order_items')->insert([
            ['po_id' => 1, 'product_id' => 'MOUSE-01', 'quantity' => 20, 'received_quantity' => 20, 'unit_price' => 450, 'total' => 9000, 'created_at' => now()],
            ['po_id' => 1, 'product_id' => 'KEY-01', 'quantity' => 10, 'received_quantity' => 10, 'unit_price' => 800, 'total' => 8000, 'created_at' => now()],
        ]);
    }
}