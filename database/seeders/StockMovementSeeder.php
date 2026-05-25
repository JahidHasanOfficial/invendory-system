<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockMovementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stock_movements')->insert([
            [
                'product_id' => 'MOUSE-01',
                'branch_id' => 1,
                'quantity_change' => 20,
                'new_quantity' => 70,
                'reference_type' => 'purchase',
                'reference_id' => 1,
                'previous_avg_price' => 450,
                'new_avg_price' => 450,
                'created_at' => now(),
                'created_by' => 7,
            ],
            [
                'product_id' => 'KEY-01',
                'branch_id' => 1,
                'quantity_change' => 10,
                'new_quantity' => 50,
                'reference_type' => 'purchase',
                'reference_id' => 1,
                'previous_avg_price' => 800,
                'new_avg_price' => 800,
                'created_at' => now(),
                'created_by' => 7,
            ],
        ]);
    }
}