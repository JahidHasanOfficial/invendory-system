<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            ['organization_id' => 1, 'short_name' => 'PCS', 'full_name' => 'Pieces', 'status' => 1],
            ['organization_id' => 1, 'short_name' => 'KG', 'full_name' => 'Kilogram', 'status' => 1],
            ['organization_id' => 1, 'short_name' => 'SET', 'full_name' => 'Set', 'status' => 1],
            ['organization_id' => 1, 'short_name' => 'BOX', 'full_name' => 'Box', 'status' => 1],
            ['organization_id' => 1, 'short_name' => 'RIM', 'full_name' => 'Rim', 'status' => 1],
        ];

        foreach ($units as $unit) {
            DB::table('units')->insert(array_merge($unit, [
                'created_at' => now(),
            ]));
        }
    }
}