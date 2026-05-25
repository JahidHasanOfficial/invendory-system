<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrentStockSeeder extends Seeder
{
    public function run(): void
    {
        $currentStocks = [
            // Head Office Store (branch_id = 1)
            ['branch_id' => 1, 'product_id' => 'PC-UTT-001', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-002', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-003', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-004', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-005', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-006', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-007', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-008', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-009', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-010', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'MOUSE-01', 'quantity' => 50, 'avg_price' => 450, 'last_cost' => 450],
            ['branch_id' => 1, 'product_id' => 'KEY-01', 'quantity' => 40, 'avg_price' => 800, 'last_cost' => 800],
            ['branch_id' => 1, 'product_id' => 'MON-01', 'quantity' => 10, 'avg_price' => 12000, 'last_cost' => 12000],
            
            // Uttara Branch
            ['branch_id' => 2, 'product_id' => 'MOUSE-01', 'quantity' => 25, 'avg_price' => 450, 'last_cost' => 450],
            ['branch_id' => 2, 'product_id' => 'KEY-01', 'quantity' => 20, 'avg_price' => 800, 'last_cost' => 800],
            ['branch_id' => 2, 'product_id' => 'LAP-UTT-001', 'quantity' => 1, 'avg_price' => 75000, 'last_cost' => 75000],
            ['branch_id' => 2, 'product_id' => 'LAP-UTT-002', 'quantity' => 1, 'avg_price' => 75000, 'last_cost' => 75000],
            
            // Gulshan Branch
            ['branch_id' => 3, 'product_id' => 'MOUSE-01', 'quantity' => 15, 'avg_price' => 450, 'last_cost' => 450],
            ['branch_id' => 3, 'product_id' => 'KEY-01', 'quantity' => 12, 'avg_price' => 800, 'last_cost' => 800],
            ['branch_id' => 3, 'product_id' => 'LAP-GUL-001', 'quantity' => 1, 'avg_price' => 68000, 'last_cost' => 68000],
            ['branch_id' => 3, 'product_id' => 'PC-GUL-001', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 3, 'product_id' => 'PC-GUL-002', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            
            // Chittagong Branch
            ['branch_id' => 4, 'product_id' => 'MOUSE-01', 'quantity' => 10, 'avg_price' => 450, 'last_cost' => 450],
            ['branch_id' => 4, 'product_id' => 'KEY-01', 'quantity' => 8, 'avg_price' => 800, 'last_cost' => 800],
            ['branch_id' => 4, 'product_id' => 'PC-CTG-001', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
        ];

        foreach ($currentStocks as $stock) {
            DB::table('current_stocks')->insert(array_merge($stock, [
                'updated_at' => now(),
            ]));
        }
    }
}