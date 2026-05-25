<?php

$dir = __DIR__ . '/database/seeders/';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

$files = [
    'DatabaseSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \$this->call([
            OrganizationSeeder::class,
            BranchSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            ProductCategorySeeder::class,
            BrandSeeder::class,
            UnitSeeder::class,
            ProductSeeder::class,
            VendorSeeder::class,
            VoucherTypeSeeder::class,
            LabSeeder::class,
            WorkstationSeeder::class,
            CurrentStockSeeder::class,
            LabStockItemSeeder::class,
            AssetAssignmentSeeder::class,
            SettingSeeder::class,
            RequisitionSeeder::class,
            PurchaseOrderSeeder::class,
            GoodsReceiptSeeder::class,
            StockMovementSeeder::class,
        ]);
    }
}
EOT,

    'OrganizationSeeder.php' => <<<EOT
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
EOT,

    'BranchSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        \$branches = [
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

        foreach (\$branches as \$branch) {
            DB::table('branches')->insert(array_merge(\$branch, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
EOT,

    'RolePermissionSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        \$roles = [
            'branch_staff',
            'branch_manager',
            'store_keeper',
            'inventory_manager',
            'hr_admin',
            'cfo',
            'md'
        ];

        foreach (\$roles as \$role) {
            Role::findOrCreate(\$role);
        }
    }
}
EOT,

    'UserSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        \$users = [
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

        foreach (\$users as \$user) {
            \$role = \$user['role'] ?? 'branch_staff';
            unset(\$user['role']);

            \$id = DB::table('users')->insertGetId(array_merge(\$user, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            \$userModel = \App\Models\User::find(\$id);
            if (\$userModel) {
                \$userModel->assignRole(\$role);
            }
        }
    }
}
EOT,

    'ProductCategorySeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        \$categories = [
            ['organization_id' => 1, 'name' => 'Computer & Laptop', 'parent_id' => null, 'description' => 'Desktop and Laptop Computers', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Peripherals', 'parent_id' => null, 'description' => 'Mouse, Keyboard, Monitor etc', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Networking', 'parent_id' => null, 'description' => 'Router, Switch, Cable', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Stationery', 'parent_id' => null, 'description' => 'Paper, Pen, Toner', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Furniture', 'parent_id' => null, 'description' => 'Chair, Table, Desk', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Desktop', 'parent_id' => 1, 'description' => 'Desktop Computer', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Laptop', 'parent_id' => 1, 'description' => 'Laptop Computer', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Mouse', 'parent_id' => 2, 'description' => 'Computer Mouse', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Keyboard', 'parent_id' => 2, 'description' => 'Computer Keyboard', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Monitor', 'parent_id' => 2, 'description' => 'Display Monitor', 'status' => 1],
        ];

        foreach (\$categories as \$category) {
            DB::table('product_categories')->insert(array_merge(\$category, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
EOT,

    'BrandSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        \$brands = [
            ['organization_id' => 1, 'name' => 'Dell', 'description' => 'Dell Computers & Peripherals', 'status' => 1],
            ['organization_id' => 1, 'name' => 'HP', 'description' => 'HP Computers & Printers', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Lenovo', 'description' => 'Lenovo Laptops', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Logitech', 'description' => 'Logitech Mouse & Keyboard', 'status' => 1],
            ['organization_id' => 1, 'name' => 'Samsung', 'description' => 'Samsung Monitors', 'status' => 1],
        ];

        foreach (\$brands as \$brand) {
            DB::table('brands')->insert(array_merge(\$brand, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
EOT,

    'UnitSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        \$units = [
            ['organization_id' => 1, 'short_name' => 'PCS', 'full_name' => 'Pieces', 'status' => 1],
            ['organization_id' => 1, 'short_name' => 'KG', 'full_name' => 'Kilogram', 'status' => 1],
            ['organization_id' => 1, 'short_name' => 'SET', 'full_name' => 'Set', 'status' => 1],
            ['organization_id' => 1, 'short_name' => 'BOX', 'full_name' => 'Box', 'status' => 1],
            ['organization_id' => 1, 'short_name' => 'RIM', 'full_name' => 'Rim', 'status' => 1],
        ];

        foreach (\$units as \$unit) {
            DB::table('units')->insert(array_merge(\$unit, [
                'created_at' => now(),
            ]));
        }
    }
}
EOT,

    'ProductSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        \$products = [
            // Desktop Computers (Uttara)
            ['id' => 'PC-UTT-001', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-001', 'barcode' => 'BAR-DELL-001', 'status' => 1],
            ['id' => 'PC-UTT-002', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-002', 'barcode' => 'BAR-DELL-002', 'status' => 1],
            ['id' => 'PC-UTT-003', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-003', 'barcode' => 'BAR-DELL-003', 'status' => 1],
            ['id' => 'PC-UTT-004', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-004', 'barcode' => 'BAR-DELL-004', 'status' => 1],
            ['id' => 'PC-UTT-005', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-005', 'barcode' => 'BAR-DELL-005', 'status' => 1],
            ['id' => 'PC-UTT-006', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-006', 'barcode' => 'BAR-DELL-006', 'status' => 1],
            ['id' => 'PC-UTT-007', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-007', 'barcode' => 'BAR-DELL-007', 'status' => 1],
            ['id' => 'PC-UTT-008', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-008', 'barcode' => 'BAR-DELL-008', 'status' => 1],
            ['id' => 'PC-UTT-009', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-009', 'barcode' => 'BAR-DELL-009', 'status' => 1],
            ['id' => 'PC-UTT-010', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-010', 'barcode' => 'BAR-DELL-010', 'status' => 1],
            
            // Gulshan Desktop
            ['id' => 'PC-GUL-001', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-011', 'barcode' => 'BAR-DELL-011', 'status' => 1],
            ['id' => 'PC-GUL-002', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-012', 'barcode' => 'BAR-DELL-012', 'status' => 1],
            
            // Chittagong Desktop
            ['id' => 'PC-CTG-001', 'organization_id' => 1, 'category_id' => 6, 'brand_id' => 1, 'name' => 'Dell Optiplex 3080 Desktop', 'purchase_price' => 45000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Optiplex 3080', 'sku' => 'SKU-DELL-013', 'barcode' => 'BAR-DELL-013', 'status' => 1],
            
            // Laptops
            ['id' => 'LAP-UTT-001', 'organization_id' => 1, 'category_id' => 7, 'brand_id' => 3, 'name' => 'Lenovo ThinkPad E14', 'purchase_price' => 75000, 'reorder_level' => 3, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'ThinkPad E14', 'sku' => 'SKU-LEN-001', 'barcode' => 'BAR-LEN-001', 'status' => 1],
            ['id' => 'LAP-UTT-002', 'organization_id' => 1, 'category_id' => 7, 'brand_id' => 3, 'name' => 'Lenovo ThinkPad E14', 'purchase_price' => 75000, 'reorder_level' => 3, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'ThinkPad E14', 'sku' => 'SKU-LEN-002', 'barcode' => 'BAR-LEN-002', 'status' => 1],
            ['id' => 'LAP-GUL-001', 'organization_id' => 1, 'category_id' => 7, 'brand_id' => 2, 'name' => 'HP Pavilion 15', 'purchase_price' => 68000, 'reorder_level' => 3, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'Pavilion 15', 'sku' => 'SKU-HP-001', 'barcode' => 'BAR-HP-001', 'status' => 1],
            
            // Peripherals
            ['id' => 'MOUSE-01', 'organization_id' => 1, 'category_id' => 8, 'brand_id' => 4, 'name' => 'Logitech B100 Mouse', 'purchase_price' => 450, 'reorder_level' => 10, 'unit_id' => 1, 'is_serial_tracked' => false, 'is_asset' => false, 'model' => 'B100', 'sku' => 'SKU-LOG-M01', 'barcode' => 'BAR-LOG-M01', 'status' => 1],
            ['id' => 'KEY-01', 'organization_id' => 1, 'category_id' => 9, 'brand_id' => 1, 'name' => 'Dell KB216 Keyboard', 'purchase_price' => 800, 'reorder_level' => 8, 'unit_id' => 1, 'is_serial_tracked' => false, 'is_asset' => false, 'model' => 'KB216', 'sku' => 'SKU-DELL-K01', 'barcode' => 'BAR-DELL-K01', 'status' => 1],
            ['id' => 'MON-01', 'organization_id' => 1, 'category_id' => 10, 'brand_id' => 5, 'name' => 'Samsung 22" Monitor', 'purchase_price' => 12000, 'reorder_level' => 5, 'unit_id' => 1, 'is_serial_tracked' => true, 'is_asset' => true, 'model' => 'LS22A', 'sku' => 'SKU-SAM-M01', 'barcode' => 'BAR-SAM-M01', 'status' => 1],
        ];

        foreach (\$products as \$product) {
            DB::table('products')->insert(array_merge(\$product, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
EOT,

    'VendorSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        \$vendors = [
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

        foreach (\$vendors as \$vendor) {
            DB::table('vendors')->insert(array_merge(\$vendor, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
EOT,

    'VoucherTypeSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherTypeSeeder extends Seeder
{
    public function run(): void
    {
        \$voucherTypes = [
            ['organization_id' => 1, 'name' => 'Purchase', 'prefix' => 'PUR', 'start_no' => 1000, 'current_no' => 1000, 'status' => 1],
            ['organization_id' => 1, 'name' => 'Transfer', 'prefix' => 'TRN', 'start_no' => 1000, 'current_no' => 1000, 'status' => 1],
            ['organization_id' => 1, 'name' => 'Return', 'prefix' => 'RET', 'start_no' => 1000, 'current_no' => 1000, 'status' => 1],
            ['organization_id' => 1, 'name' => 'Stock Adjustment', 'prefix' => 'ADJ', 'start_no' => 1000, 'current_no' => 1000, 'status' => 1],
        ];

        foreach (\$voucherTypes as \$voucherType) {
            DB::table('voucher_types')->insert(array_merge(\$voucherType, [
                'created_at' => now(),
            ]));
        }
    }
}
EOT,

    'LabSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabSeeder extends Seeder
{
    public function run(): void
    {
        \$labs = [
            ['branch_id' => 2, 'name' => 'Lab-01 (Main Lab)', 'lab_code' => 'UTT-LAB01', 'lab_type' => 'training_lab', 'capacity' => 25, 'floor' => '2nd Floor', 'status' => 1],
            ['branch_id' => 2, 'name' => 'Lab-02 (Advanced Lab)', 'lab_code' => 'UTT-LAB02', 'lab_type' => 'training_lab', 'capacity' => 20, 'floor' => '2nd Floor', 'status' => 1],
            ['branch_id' => 2, 'name' => 'Instructor Room', 'lab_code' => 'UTT-INS01', 'lab_type' => 'instructor_room', 'capacity' => 5, 'floor' => '3rd Floor', 'status' => 1],
            ['branch_id' => 2, 'name' => 'Store Room', 'lab_code' => 'UTT-STORE', 'lab_type' => 'store_room', 'capacity' => 50, 'floor' => 'Ground Floor', 'status' => 1],
        ];

        foreach (\$labs as \$lab) {
            DB::table('labs')->insert(array_merge(\$lab, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
EOT,

    'WorkstationSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkstationSeeder extends Seeder
{
    public function run(): void
    {
        // Lab-01 এর জন্য (25 seats - IDs 1 to 20 in code, but we'll map properly)
        for (\$i = 1; \$i <= 20; \$i++) {
            \$status = (\$i <= 10) ? 'occupied' : ((\$i == 16) ? 'under_repair' : 'empty');
            DB::table('workstations')->insert([
                'lab_id' => 1,
                'workstation_code' => 'WS-' . str_pad(\$i, 2, '0', STR_PAD_LEFT),
                'workstation_type' => 'student',
                'status' => \$status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // Lab-02 এর জন্য (20 seats)
        for (\$i = 1; \$i <= 20; \$i++) {
            \$status = (\$i <= 10) ? 'occupied' : 'empty';
            DB::table('workstations')->insert([
                'lab_id' => 2,
                'workstation_code' => 'WS-' . str_pad(\$i, 2, '0', STR_PAD_LEFT),
                'workstation_type' => 'student',
                'status' => \$status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
EOT,

    'CurrentStockSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrentStockSeeder extends Seeder
{
    public function run(): void
    {
        \$currentStocks = [
            // Head Office Store (branch_id = 1)
            ['branch_id' => 1, 'product_id' => 'PC-UTT-001', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-002', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-003', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-004', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-005', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-006', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-007', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-008', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-009', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'PC-UTT-010', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 1, 'product_id' => 'MOUSE-01', 'quantity' => 50, 'avg_price' => 450, 'last_cost' => 450],
            ['branch_id' => 1, 'product_id' => 'KEY-01', 'quantity' => 40, 'avg_price' => 800, 'last_cost' => 800],
            ['branch_id' => 1, 'product_id' => 'MON-01', 'quantity' => 10, 'avg_price' => 12000, 'last_cost' => 12000],
            
            // Uttara Branch
            ['branch_id' => 2, 'product_id' => 'MOUSE-01', 'quantity' => 25, 'avg_price' => 450, 'last_cost' => 450],
            ['branch_id' => 2, 'product_id' => 'KEY-01', 'quantity' => 20, 'avg_price' => 800, 'last_cost' => 800],
            ['branch_id' => 2, 'product_id' => 'LAP-UTT-001', 'quantity' => 1, 'avg_price' => 75000, 'last_cost' => 75000],
            ['branch_id' => 2, 'product_id' => 'LAP-UTT-002', 'quantity' => 1, 'avg_price' => 75000, 'last_cost' => 75000],
            
            // Gulshan Branch
            ['branch_id' => 3, 'product_id' => 'MOUSE-01', 'quantity' => 15, 'avg_price' => 450, 'last_cost' => 450],
            ['branch_id' => 3, 'product_id' => 'KEY-01', 'quantity' => 12, 'avg_price' => 800, 'last_cost' => 800],
            ['branch_id' => 3, 'product_id' => 'LAP-GUL-001', 'quantity' => 1, 'avg_price' => 68000, 'last_cost' => 68000],
            ['branch_id' => 3, 'product_id' => 'PC-GUL-001', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            ['branch_id' => 3, 'product_id' => 'PC-GUL-002', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
            
            // Chittagong Branch
            ['branch_id' => 4, 'product_id' => 'MOUSE-01', 'quantity' => 10, 'avg_price' => 450, 'last_cost' => 450],
            ['branch_id' => 4, 'product_id' => 'KEY-01', 'quantity' => 8, 'avg_price' => 800, 'last_cost' => 800],
            ['branch_id' => 4, 'product_id' => 'PC-CTG-001', 'quantity' => 1, 'avg_price' => 45000, 'last_cost' => 45000],
        ];

        foreach (\$currentStocks as \$stock) {
            DB::table('current_stocks')->insert(array_merge(\$stock, [
                'updated_at' => now(),
            ]));
        }
    }
}
EOT,

    'LabStockItemSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabStockItemSeeder extends Seeder
{
    public function run(): void
    {
        // Lab-01 এর পিসি (workstation 1-10)
        for (\$i = 1; \$i <= 10; \$i++) {
            DB::table('lab_stock_items')->insert([
                'lab_id' => 1,
                'product_id' => 'PC-UTT-' . str_pad(\$i, 3, '0', STR_PAD_LEFT),
                'quantity' => 1,
                'workstation_id' => \$i,
                'updated_at' => now(),
            ]);
        }
        
        // Lab-02 এর পিসি (workstation 21-25)
        for (\$i = 1; \$i <= 5; \$i++) {
            DB::table('lab_stock_items')->insert([
                'lab_id' => 2,
                'product_id' => 'PC-UTT-' . str_pad(\$i, 3, '0', STR_PAD_LEFT),
                'quantity' => 1,
                'workstation_id' => 20 + \$i,
                'updated_at' => now(),
            ]);
        }
        
        // পেরিফেরালস (lab wise)
        \$peripherals = [
            ['lab_id' => 1, 'product_id' => 'MOUSE-01', 'quantity' => 25],
            ['lab_id' => 1, 'product_id' => 'KEY-01', 'quantity' => 20],
            ['lab_id' => 2, 'product_id' => 'MOUSE-01', 'quantity' => 20],
            ['lab_id' => 2, 'product_id' => 'KEY-01', 'quantity' => 18],
            ['lab_id' => 3, 'product_id' => 'MOUSE-01', 'quantity' => 5],
            ['lab_id' => 3, 'product_id' => 'KEY-01', 'quantity' => 5],
        ];
        
        foreach (\$peripherals as \$peripheral) {
            DB::table('lab_stock_items')->insert(array_merge(\$peripheral, [
                'workstation_id' => null,
                'updated_at' => now(),
            ]));
        }
    }
}
EOT,

    'AssetAssignmentSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        \$assignments = [
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

        foreach (\$assignments as \$assignment) {
            DB::table('asset_assignments')->insert(array_merge(\$assignment, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
EOT,

    'SettingSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        \$settings = [
            ['organization_id' => 1, 'setting_key' => 'company_name', 'setting_value' => 'e-Learning & Associates Ltd.', 'setting_type' => 'text'],
            ['organization_id' => 1, 'setting_key' => 'reorder_alert_email', 'setting_value' => 'inventory@e-laeltd.com', 'setting_type' => 'text'],
            ['organization_id' => 1, 'setting_key' => 'auto_backup_time', 'setting_value' => '02:00', 'setting_type' => 'text'],
            ['organization_id' => 1, 'setting_key' => 'low_stock_threshold_percentage', 'setting_value' => '20', 'setting_type' => 'number'],
            ['organization_id' => 1, 'setting_key' => 'cfo_approval_threshold', 'setting_value' => '50000', 'setting_type' => 'number'],
            ['organization_id' => 1, 'setting_key' => 'auto_requisition_enabled', 'setting_value' => 'false', 'setting_type' => 'boolean'],
        ];

        foreach (\$settings as \$setting) {
            DB::table('settings')->insert(array_merge(\$setting, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
EOT,

    'RequisitionSeeder.php' => <<<EOT
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
EOT,

    'PurchaseOrderSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseOrderSeeder extends Seeder
{
    public function run(): void
    {
        // Insert purchase order
        DB::table('purchase_orders')->insert([
            'organization_id' => 1,
            'po_no' => 'PO-2026-0001',
            'vendor_id' => 1,
            'branch_id' => 1,
            'order_date' => '2026-05-21',
            'expected_delivery_date' => '2026-05-28',
            'subtotal' => 17000,
            'tax_amount' => 0,
            'shipping_cost' => 200,
            'total_amount' => 17200,
            'status' => 'received',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Insert purchase order items
        DB::table('purchase_order_items')->insert([
            ['po_id' => 1, 'product_id' => 'MOUSE-01', 'quantity' => 20, 'received_quantity' => 20, 'unit_price' => 450, 'total' => 9000, 'created_at' => now()],
            ['po_id' => 1, 'product_id' => 'KEY-01', 'quantity' => 10, 'received_quantity' => 10, 'unit_price' => 800, 'total' => 8000, 'created_at' => now()],
        ]);
    }
}
EOT,

    'GoodsReceiptSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsReceiptSeeder extends Seeder
{
    public function run(): void
    {
        // Insert goods receipt
        DB::table('goods_receipts')->insert([
            'organization_id' => 1,
            'gr_no' => 'GR-2026-0001',
            'po_id' => 1,
            'received_date' => '2026-05-27',
            'received_by' => 7,
            'branch_id' => 1,
            'status' => 'completed',
            'created_at' => now(),
        ]);
        
        // Insert goods receipt items
        DB::table('goods_receipt_items')->insert([
            ['gr_id' => 1, 'product_id' => 'MOUSE-01', 'quantity_received' => 20, 'condition' => 'good', 'created_at' => now()],
            ['gr_id' => 1, 'product_id' => 'KEY-01', 'quantity_received' => 10, 'condition' => 'good', 'created_at' => now()],
        ]);
    }
}
EOT,

    'StockMovementSeeder.php' => <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockMovementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stock_movements')->insert([
            [
                'product_id' => 'MOUSE-01',
                'branch_id' => 1,
                'quantity_change' => 20,
                'new_quantity' => 70,
                'reference_type' => 'purchase',
                'reference_id' => 1,
                'previous_avg_price' => 450,
                'new_avg_price' => 450,
                'created_at' => now(),
                'created_by' => 7,
            ],
            [
                'product_id' => 'KEY-01',
                'branch_id' => 1,
                'quantity_change' => 10,
                'new_quantity' => 50,
                'reference_type' => 'purchase',
                'reference_id' => 1,
                'previous_avg_price' => 800,
                'new_avg_price' => 800,
                'created_at' => now(),
                'created_by' => 7,
            ],
        ]);
    }
}
EOT,
];

foreach ($files as $name => $content) {
    file_put_contents($dir . $name, $content);
}
echo "Generated all seeders!\n";
