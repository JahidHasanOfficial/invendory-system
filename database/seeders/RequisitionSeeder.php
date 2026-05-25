<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequisitionSeeder extends Seeder
{
    public function run(): void
    {
        // Insert requisition
        DB::table('requisitions')->insert([
            'organization_id' => 1,
            'req_no' => 'REQ-2026-0001',
            'requester_branch_id' => 2,
            'requested_by' => 3,
            'requested_date' => '2026-05-20',
            'required_by_date' => '2026-05-25',
            'priority' => 'medium',
            'purpose' => 'New student batch joining next month, need additional mice and keyboards',
            'status' => 'approved',
            'current_approval_level' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Insert requisition items
        DB::table('requisition_items')->insert([
            ['requisition_id' => 1, 'product_id' => 'MOUSE-01', 'quantity_requested' => 20, 'quantity_approved' => 20, 'quantity_issued' => 0, 'unit_price_estimate' => 450, 'created_at' => now()],
            ['requisition_id' => 1, 'product_id' => 'KEY-01', 'quantity_requested' => 10, 'quantity_approved' => 10, 'quantity_issued' => 0, 'unit_price_estimate' => 800, 'created_at' => now()],
        ]);
    }
}