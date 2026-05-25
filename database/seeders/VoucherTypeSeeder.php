<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherTypeSeeder extends Seeder
{
    public function run(): void
    {
        $voucherTypes = [
            ['organization_id' => 1, 'name' => 'Purchase', 'prefix' => 'PUR', 'start_no' => 1000, 'current_no' => 1000, 'status' => 1],
            ['organization_id' => 1, 'name' => 'Transfer', 'prefix' => 'TRN', 'start_no' => 1000, 'current_no' => 1000, 'status' => 1],
            ['organization_id' => 1, 'name' => 'Return', 'prefix' => 'RET', 'start_no' => 1000, 'current_no' => 1000, 'status' => 1],
            ['organization_id' => 1, 'name' => 'Stock Adjustment', 'prefix' => 'ADJ', 'start_no' => 1000, 'current_no' => 1000, 'status' => 1],
        ];

        foreach ($voucherTypes as $voucherType) {
            DB::table('voucher_types')->insert(array_merge($voucherType, [
                'created_at' => now(),
            ]));
        }
    }
}