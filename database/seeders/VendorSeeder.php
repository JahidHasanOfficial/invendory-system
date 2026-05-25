<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        $vendors = [
            [
                'organization_id' => 1,
                'name' => 'Computer Bazar Ltd.',
                'code' => 'CB-001',
                'contact_person' => 'Mr. Rahman',
                'phone' => '01711111111',
                'email' => 'rahman@computerbazar.com',
                'address' => 'Multiplan Center, Dhaka',
                'payment_terms' => '30 Days',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'name' => 'IT Solution BD',
                'code' => 'ITS-001',
                'contact_person' => 'Mr. Hasan',
                'phone' => '01722222222',
                'email' => 'hasan@itsolutionbd.com',
                'address' => 'Bashundhara City, Dhaka',
                'payment_terms' => 'Advance',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'name' => 'Global Technology',
                'code' => 'GT-001',
                'contact_person' => 'Ms. Tania',
                'phone' => '01733333333',
                'email' => 'tania@globaltech.com',
                'address' => 'Uttara, Dhaka',
                'payment_terms' => '15 Days',
                'status' => 1,
            ],
        ];

        foreach ($vendors as $vendor) {
            DB::table('vendors')->insert(array_merge($vendor, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}