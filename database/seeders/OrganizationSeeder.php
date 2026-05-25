<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('organizations')->insert([
            'id' => 1,
            'name' => 'e-Learning & Associates Ltd.',
            'code' => 'ELA',
            'address' => 'House 12, Road 10, Uttara, Dhaka',
            'phone' => '+8801712345678',
            'email' => 'info@e-laeltd.com',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}