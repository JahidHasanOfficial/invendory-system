<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['organization_id' => 1, 'name' => 'Computer & Laptop', 'parent_id' => null, 'description' => 'Desktop and Laptop Computers', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Peripherals', 'parent_id' => null, 'description' => 'Mouse, Keyboard, Monitor etc', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Networking', 'parent_id' => null, 'description' => 'Router, Switch, Cable', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Stationery', 'parent_id' => null, 'description' => 'Paper, Pen, Toner', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Furniture', 'parent_id' => null, 'description' => 'Chair, Table, Desk', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Desktop', 'parent_id' => 1, 'description' => 'Desktop Computer', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Laptop', 'parent_id' => 1, 'description' => 'Laptop Computer', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Mouse', 'parent_id' => 2, 'description' => 'Computer Mouse', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Keyboard', 'parent_id' => 2, 'description' => 'Computer Keyboard', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Monitor', 'parent_id' => 2, 'description' => 'Display Monitor', 'status' => 1],
        ];

        foreach ($categories as $category) {
            DB::table('product_categories')->insert(array_merge($category, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}