<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsReceiptSeeder extends Seeder
{
    public function run(): void
    {
        // Insert goods receipt
        DB::table('goods_receipts')->insert([
            'organization_id' => 1,
            'gr_no' => 'GR-2026-0001',
            'po_id' => 1,
            'received_date' => '2026-05-27',
            'received_by' => 7,
            'branch_id' => 1,
            'status' => 'completed',
            'created_at' => now(),
        ]);
        
        // Insert goods receipt items
        DB::table('goods_receipt_items')->insert([
            ['gr_id' => 1, 'product_id' => 'MOUSE-01', 'quantity_received' => 20, 'condition' => 'good', 'created_at' => now()],
            ['gr_id' => 1, 'product_id' => 'KEY-01', 'quantity_received' => 10, 'condition' => 'good', 'created_at' => now()],
        ]);
    }
}