<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabStockItemSeeder extends Seeder
{
    public function run(): void
    {
        // Lab-01 এর পিসি (workstation 1-10)
        for ($i = 1; $i <= 10; $i++) {
            DB::table('lab_stock_items')->insert([
                'lab_id' => 1,
                'product_id' => 'PC-UTT-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'quantity' => 1,
                'workstation_id' => $i,
                'updated_at' => now(),
            ]);
        }
        
        // Lab-02 এর পিসি (workstation 21-25)
        for ($i = 1; $i <= 5; $i++) {
            DB::table('lab_stock_items')->insert([
                'lab_id' => 2,
                'product_id' => 'PC-UTT-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'quantity' => 1,
                'workstation_id' => 20 + $i,
                'updated_at' => now(),
            ]);
        }
        
        // পেরিফেরালস (lab wise)
        $peripherals = [
            ['lab_id' => 1, 'product_id' => 'MOUSE-01', 'quantity' => 25],
            ['lab_id' => 1, 'product_id' => 'KEY-01', 'quantity' => 20],
            ['lab_id' => 2, 'product_id' => 'MOUSE-01', 'quantity' => 20],
            ['lab_id' => 2, 'product_id' => 'KEY-01', 'quantity' => 18],
            ['lab_id' => 3, 'product_id' => 'MOUSE-01', 'quantity' => 5],
            ['lab_id' => 3, 'product_id' => 'KEY-01', 'quantity' => 5],
        ];
        
        foreach ($peripherals as $peripheral) {
            DB::table('lab_stock_items')->insert(array_merge($peripheral, [
                'workstation_id' => null,
                'updated_at' => now(),
            ]));
        }
    }
}