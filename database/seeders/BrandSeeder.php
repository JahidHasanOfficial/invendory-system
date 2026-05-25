<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['organization_id' => 1, 'name' => 'Dell', 'description' => 'Dell Computers & Peripherals', 'status' => 1],
            ['organization_id' => 1, 'name' => 'HP', 'description' => 'HP Computers & Printers', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Lenovo', 'description' => 'Lenovo Laptops', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Logitech', 'description' => 'Logitech Mouse & Keyboard', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Samsung', 'description' => 'Samsung Monitors', 'status' => 1],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert(array_merge($brand, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}