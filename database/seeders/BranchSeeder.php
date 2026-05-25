<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            [
                'organization_id' => 1,
                'name' => 'Head Office',
                'code' => 'HO',
                'branch_type' => 'head_office',
                'address' => 'Uttara, Dhaka',
                'contact_person' => 'Mr. Mahmud',
                'phone' => '+8801712345601',
                'email' => 'ho@e-laeltd.com',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'name' => 'Uttara Training Center',
                'code' => 'UTT',
                'branch_type' => 'training_center',
                'address' => 'Uttara Sector 10, Dhaka',
                'contact_person' => 'Mr. Rafiq',
                'phone' => '+8801712345602',
                'email' => 'uttara@e-laeltd.com',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'name' => 'Gulshan Training Center',
                'code' => 'GUL',
                'branch_type' => 'training_center',
                'address' => 'Gulshan 2, Dhaka',
                'contact_person' => 'Ms. Sharmin',
                'phone' => '+8801712345603',
                'email' => 'gulshan@e-laeltd.com',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'name' => 'Chittagong Training Center',
                'code' => 'CTG',
                'branch_type' => 'training_center',
                'address' => 'Agrabad, Chittagong',
                'contact_person' => 'Mr. Nazim',
                'phone' => '+8801712345604',
                'email' => 'ctg@e-laeltd.com',
                'status' => 1,
            ],
        ];

        foreach ($branches as $branch) {
            DB::table('branches')->insert(array_merge($branch, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}