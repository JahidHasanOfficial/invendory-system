<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkstationSeeder extends Seeder
{
    public function run(): void
    {
        // Lab-01 এর জন্য (25 seats - IDs 1 to 20 in code, but we'll map properly)
        for ($i = 1; $i <= 20; $i++) {
            $status = ($i <= 10) ? 'occupied' : (($i == 16) ? 'under_repair' : 'empty');
            DB::table('workstations')->insert([
                'lab_id' => 1,
                'workstation_code' => 'WS-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'workstation_type' => 'student',
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // Lab-02 এর জন্য (20 seats)
        for ($i = 1; $i <= 20; $i++) {
            $status = ($i <= 10) ? 'occupied' : 'empty';
            DB::table('workstations')->insert([
                'lab_id' => 2,
                'workstation_code' => 'WS-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'workstation_type' => 'student',
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}