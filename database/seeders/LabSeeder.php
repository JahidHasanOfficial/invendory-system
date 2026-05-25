<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabSeeder extends Seeder
{
    public function run(): void
    {
        $labs = [
            ['branch_id' => 2, 'name' => 'Lab-01 (Main Lab)', 'lab_code' => 'UTT-LAB01', 'lab_type' => 'training_lab', 'capacity' => 25, 'floor' => '2nd Floor', 'status' => 1],
            ['branch_id' => 2, 'name' => 'Lab-02 (Advanced Lab)', 'lab_code' => 'UTT-LAB02', 'lab_type' => 'training_lab', 'capacity' => 20, 'floor' => '2nd Floor', 'status' => 1],
            ['branch_id' => 2, 'name' => 'Instructor Room', 'lab_code' => 'UTT-INS01', 'lab_type' => 'instructor_room', 'capacity' => 5, 'floor' => '3rd Floor', 'status' => 1],
            ['branch_id' => 2, 'name' => 'Store Room', 'lab_code' => 'UTT-STORE', 'lab_type' => 'store_room', 'capacity' => 50, 'floor' => 'Ground Floor', 'status' => 1],
        ];

        foreach ($labs as $lab) {
            DB::table('labs')->insert(array_merge($lab, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}