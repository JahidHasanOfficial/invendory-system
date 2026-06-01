<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'organization_id' => 1,
                'branch_id' => 1,
                'employee_id' => 'EMP-000',
                'name' => 'Super Admin',
                'email' => 'superadmin@e-laeltd.com',
                'phone' => '01700000000',
                'password' => Hash::make('12345678'),
                'role' => 'super_admin',
                'designation' => 'Super Admin',
                'joining_date' => '2020-01-01',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'branch_id' => 1,
                'employee_id' => 'EMP-001',
                'name' => 'Mahmud Hasan',
                'email' => 'mahmud@e-laeltd.com',
                'phone' => '01710000001',
                'password' => Hash::make('12345678'),
                'role' => 'inventory_manager',
                'designation' => 'Inventory Manager',
                'joining_date' => '2020-01-15',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'branch_id' => 2,
                'employee_id' => 'EMP-002',
                'name' => 'Rafiqul Islam',
                'email' => 'rafiq@e-laeltd.com',
                'phone' => '01710000002',
                'password' => Hash::make('12345678'),
                'role' => 'branch_manager',
                'designation' => 'Branch Manager',
                'joining_date' => '2020-03-10',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'branch_id' => 2,
                'employee_id' => 'EMP-003',
                'name' => 'Shahinur Akter',
                'email' => 'shahinur@e-laeltd.com',
                'phone' => '01710000003',
                'password' => Hash::make('12345678'),
                'role' => 'branch_staff',
                'designation' => 'Senior Trainer',
                'joining_date' => '2021-01-20',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'branch_id' => 2,
                'employee_id' => 'EMP-004',
                'name' => 'Rakib Hossain',
                'email' => 'rakib@e-laeltd.com',
                'phone' => '01710000004',
                'password' => Hash::make('12345678'),
                'role' => 'branch_staff',
                'designation' => 'Trainer',
                'joining_date' => '2022-06-15',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'branch_id' => 3,
                'employee_id' => 'EMP-005',
                'name' => 'Sharmin Sultana',
                'email' => 'sharmin@e-laeltd.com',
                'phone' => '01710000005',
                'password' => Hash::make('12345678'),
                'role' => 'branch_manager',
                'designation' => 'Branch Manager',
                'joining_date' => '2020-05-20',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'branch_id' => 3,
                'employee_id' => 'EMP-006',
                'name' => 'Tanvir Ahmed',
                'email' => 'tanvir@e-laeltd.com',
                'phone' => '01710000006',
                'password' => Hash::make('12345678'),
                'role' => 'branch_staff',
                'designation' => 'Trainer',
                'joining_date' => '2021-08-10',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'branch_id' => 1,
                'employee_id' => 'EMP-007',
                'name' => 'Kazi Rana',
                'email' => 'rana@e-laeltd.com',
                'phone' => '01710000007',
                'password' => Hash::make('12345678'),
                'role' => 'store_keeper',
                'designation' => 'Store Keeper',
                'joining_date' => '2020-02-01',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'branch_id' => 1,
                'employee_id' => 'EMP-008',
                'name' => 'Farhana Parvin',
                'email' => 'farhana@e-laeltd.com',
                'phone' => '01710000008',
                'password' => Hash::make('12345678'),
                'role' => 'hr_admin',
                'designation' => 'HR Admin',
                'joining_date' => '2019-11-15',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'branch_id' => 1,
                'employee_id' => 'EMP-009',
                'name' => 'Kamal Hossain',
                'email' => 'kamal@e-laeltd.com',
                'phone' => '01710000009',
                'password' => Hash::make('12345678'),
                'role' => 'cfo',
                'designation' => 'CFO',
                'joining_date' => '2018-01-10',
                'status' => 1,
            ],
            [
                'organization_id' => 1,
                'branch_id' => 4,
                'employee_id' => 'EMP-010',
                'name' => 'Nazim Uddin',
                'email' => 'nazim@e-laeltd.com',
                'phone' => '01710000010',
                'password' => Hash::make('12345678'),
                'role' => 'branch_manager',
                'designation' => 'Branch Manager',
                'joining_date' => '2021-03-15',
                'status' => 1,
            ],
        ];

        foreach ($users as $user) {
            $role = $user['role'] ?? 'branch_staff';
            unset($user['role']);

            $id = DB::table('users')->insertGetId(array_merge($user, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            $userModel = \App\Models\User::find($id);
            if ($userModel) {
                $userModel->assignRole($role);
            }
        }
    }
}