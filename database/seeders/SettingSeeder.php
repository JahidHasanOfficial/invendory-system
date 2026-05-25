<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['organization_id' => 1, 'setting_key' => 'company_name', 'setting_value' => 'e-Learning & Associates Ltd.', 'setting_type' => 'text'],
            ['organization_id' => 1, 'setting_key' => 'reorder_alert_email', 'setting_value' => 'inventory@e-laeltd.com', 'setting_type' => 'text'],
            ['organization_id' => 1, 'setting_key' => 'auto_backup_time', 'setting_value' => '02:00', 'setting_type' => 'text'],
            ['organization_id' => 1, 'setting_key' => 'low_stock_threshold_percentage', 'setting_value' => '20', 'setting_type' => 'number'],
            ['organization_id' => 1, 'setting_key' => 'cfo_approval_threshold', 'setting_value' => '50000', 'setting_type' => 'number'],
            ['organization_id' => 1, 'setting_key' => 'auto_requisition_enabled', 'setting_value' => 'false', 'setting_type' => 'boolean'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->insert(array_merge($setting, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}