<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $assignments = [
            // Laptops assigned to trainers (permanent)
            ['product_id' => 'LAP-UTT-001', 'serial_no' => 'SER-LEN-001', 'branch_id' => 2, 'assigned_to_user_id' => 4, 'assigned_by' => 2, 'assigned_date' => '2024-01-15', 'assignment_type' => 'permanent', 'status' => 'assigned'],
            ['product_id' => 'LAP-UTT-002', 'serial_no' => 'SER-LEN-002', 'branch_id' => 2, 'assigned_to_user_id' => 3, 'assigned_by' => 2, 'assigned_date' => '2024-02-10', 'assignment_type' => 'permanent', 'status' => 'assigned'],
            ['product_id' => 'LAP-GUL-001', 'serial_no' => 'SER-HP-001', 'branch_id' => 3, 'assigned_to_user_id' => 6, 'assigned_by' => 5, 'assigned_date' => '2024-03-01', 'assignment_type' => 'permanent', 'status' => 'assigned'],
            
            // Lab-01 workstations (lab_assigned)
            ['product_id' => 'PC-UTT-001', 'serial_no' => 'SER-DELL-001', 'branch_id' => 2, 'lab_id' => 1, 'workstation_id' => 1, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-UTT-002', 'serial_no' => 'SER-DELL-002', 'branch_id' => 2, 'lab_id' => 1, 'workstation_id' => 2, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-UTT-003', 'serial_no' => 'SER-DELL-003', 'branch_id' => 2, 'lab_id' => 1, 'workstation_id' => 3, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-UTT-004', 'serial_no' => 'SER-DELL-004', 'branch_id' => 2, 'lab_id' => 1, 'workstation_id' => 4, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-UTT-005', 'serial_no' => 'SER-DELL-005', 'branch_id' => 2, 'lab_id' => 1, 'workstation_id' => 5, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-UTT-006', 'serial_no' => 'SER-DELL-006', 'branch_id' => 2, 'lab_id' => 1, 'workstation_id' => 6, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-UTT-007', 'serial_no' => 'SER-DELL-007', 'branch_id' => 2, 'lab_id' => 1, 'workstation_id' => 7, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-UTT-008', 'serial_no' => 'SER-DELL-008', 'branch_id' => 2, 'lab_id' => 1, 'workstation_id' => 8, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-UTT-009', 'serial_no' => 'SER-DELL-009', 'branch_id' => 2, 'lab_id' => 1, 'workstation_id' => 9, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-UTT-010', 'serial_no' => 'SER-DELL-010', 'branch_id' => 2, 'lab_id' => 1, 'workstation_id' => 10, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            
            // Lab-02 workstations
            ['product_id' => 'PC-UTT-001', 'serial_no' => 'SER-DELL-011', 'branch_id' => 2, 'lab_id' => 2, 'workstation_id' => 21, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-UTT-002', 'serial_no' => 'SER-DELL-012', 'branch_id' => 2, 'lab_id' => 2, 'workstation_id' => 22, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-UTT-003', 'serial_no' => 'SER-DELL-013', 'branch_id' => 2, 'lab_id' => 2, 'workstation_id' => 23, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-UTT-004', 'serial_no' => 'SER-DELL-014', 'branch_id' => 2, 'lab_id' => 2, 'workstation_id' => 24, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-UTT-005', 'serial_no' => 'SER-DELL-015', 'branch_id' => 2, 'lab_id' => 2, 'workstation_id' => 25, 'assigned_to_user_id' => 2, 'assigned_by' => 2, 'assigned_date' => '2024-01-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            
            // Gulshan branch
            ['product_id' => 'PC-GUL-001', 'serial_no' => 'SER-DELL-016', 'branch_id' => 3, 'assigned_to_user_id' => 5, 'assigned_by' => 5, 'assigned_date' => '2024-02-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            ['product_id' => 'PC-GUL-002', 'serial_no' => 'SER-DELL-017', 'branch_id' => 3, 'assigned_to_user_id' => 5, 'assigned_by' => 5, 'assigned_date' => '2024-02-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
            
            // Chittagong branch
            ['product_id' => 'PC-CTG-001', 'serial_no' => 'SER-DELL-018', 'branch_id' => 4, 'assigned_to_user_id' => 10, 'assigned_by' => 10, 'assigned_date' => '2024-03-01', 'assignment_type' => 'lab_assigned', 'status' => 'assigned'],
        ];

        foreach ($assignments as $assignment) {
            DB::table('asset_assignments')->insert(array_merge($assignment, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}