<?php

$migrations = [
    [
        'table' => 'organizations',
        'schema_up' => "
            \$table->id();
            \$table->string('name', 200);
            \$table->string('code', 50)->unique()->nullable();
            \$table->text('address')->nullable();
            \$table->string('phone', 20)->nullable();
            \$table->string('email', 100)->nullable();
            \$table->string('logo', 255)->nullable();
            \$table->tinyInteger('status')->default(1);
            \$table->timestamps();
            
            \$table->index('status');"
    ],
    [
        'table' => 'branches',
        'schema_up' => "
            \$table->increments('id');
            \$table->unsignedBigInteger('organization_id');
            \$table->string('name', 100);
            \$table->string('code', 20)->unique();
            \$table->enum('branch_type', ['head_office', 'training_center', 'warehouse'])->default('training_center');
            \$table->text('address')->nullable();
            \$table->string('contact_person', 100)->nullable();
            \$table->string('phone', 20)->nullable();
            \$table->string('email', 100)->nullable();
            \$table->tinyInteger('status')->default(1);
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            
            \$table->index('organization_id');
            \$table->index('status');"
    ],
    [
        'table' => 'users',
        'schema_up' => "
            \$table->increments('id');
            \$table->unsignedBigInteger('organization_id');
            \$table->unsignedInteger('branch_id')->nullable();
            \$table->string('employee_id', 50)->unique()->nullable();
            \$table->string('name', 100);
            \$table->string('email', 100)->unique();
            \$table->string('phone', 20)->nullable();
            \$table->string('password', 255);
            \$table->enum('role', ['branch_staff', 'branch_manager', 'store_keeper', 'inventory_manager', 'hr_admin', 'cfo', 'md'])->default('branch_staff');
            \$table->string('designation', 100)->nullable();
            \$table->date('joining_date')->nullable();
            \$table->tinyInteger('status')->default(1);
            \$table->timestamp('last_login')->nullable();
            \$table->rememberToken();
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            \$table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
            
            \$table->index('organization_id');
            \$table->index('branch_id');
            \$table->index('role');
            \$table->index('status');"
    ],
    [
        'table' => 'password_reset_tokens',
        'schema_up' => "
            \$table->string('email')->primary();
            \$table->string('token');
            \$table->timestamp('created_at')->nullable();"
    ],
    [
        'table' => 'sessions',
        'schema_up' => "
            \$table->string('id')->primary();
            \$table->unsignedInteger('user_id')->nullable();
            \$table->string('ip_address', 45)->nullable();
            \$table->text('user_agent')->nullable();
            \$table->longText('payload');
            \$table->integer('last_activity')->index();"
    ],
    [
        'table' => 'product_categories',
        'schema_up' => "
            \$table->increments('id');
            \$table->unsignedBigInteger('organization_id');
            \$table->unsignedInteger('parent_id')->nullable();
            \$table->string('name', 60);
            \$table->text('description')->nullable();
            \$table->boolean('status')->default(true);
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            \$table->foreign('parent_id')->references('id')->on('product_categories')->onDelete('set null');
            
            \$table->index('organization_id');
            \$table->index('parent_id');
            \$table->index('status');"
    ],
    [
        'table' => 'brands',
        'schema_up' => "
            \$table->increments('id');
            \$table->unsignedBigInteger('organization_id');
            \$table->string('name', 60);
            \$table->text('description')->nullable();
            \$table->boolean('status')->default(true);
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            
            \$table->index('organization_id');
            \$table->index('status');"
    ],
    [
        'table' => 'units',
        'schema_up' => "
            \$table->increments('id');
            \$table->unsignedBigInteger('organization_id');
            \$table->string('short_name', 40);
            \$table->string('full_name', 100);
            \$table->tinyInteger('status')->default(1);
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            
            \$table->index('organization_id');
            \$table->index('status');"
    ],
    [
        'table' => 'products',
        'schema_up' => "
            \$table->string('id', 20)->primary();
            \$table->unsignedBigInteger('organization_id');
            \$table->unsignedInteger('category_id')->nullable();
            \$table->unsignedInteger('brand_id')->nullable();
            \$table->string('name', 200);
            \$table->text('short_description')->nullable();
            \$table->text('long_description')->nullable();
            \$table->decimal('purchase_price', 12, 2)->default(0.00);
            \$table->integer('reorder_level')->default(0);
            \$table->unsignedInteger('unit_id')->nullable();
            \$table->string('model', 100)->nullable();
            \$table->string('barcode', 50)->unique()->nullable();
            \$table->string('sku', 50)->unique()->nullable();
            \$table->string('image', 255)->nullable();
            \$table->decimal('weight', 10, 3)->default(0.000);
            \$table->boolean('is_batch_tracked')->default(false);
            \$table->boolean('is_serial_tracked')->default(false);
            \$table->boolean('is_asset')->default(false);
            \$table->integer('warranty_period_months')->default(0);
            \$table->decimal('min_stock', 12, 2)->default(0);
            \$table->decimal('max_stock', 12, 2)->default(0);
            \$table->tinyInteger('status')->default(1);
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            \$table->foreign('category_id')->references('id')->on('product_categories')->onDelete('set null');
            \$table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
            \$table->foreign('unit_id')->references('id')->on('units')->onDelete('set null');
            
            \$table->index('organization_id', 'idx_products_organization');
            \$table->index('category_id', 'idx_products_category');
            \$table->index('brand_id', 'idx_products_brand');
            \$table->index('unit_id');
            \$table->index('status', 'idx_products_status');
            \$table->index('sku', 'idx_products_sku');
            \$table->index('barcode', 'idx_products_barcode');"
    ],
    [
        'table' => 'vendors',
        'schema_up' => "
            \$table->increments('id');
            \$table->unsignedBigInteger('organization_id');
            \$table->string('name', 100);
            \$table->string('code', 30)->unique()->nullable();
            \$table->string('contact_person', 100)->nullable();
            \$table->string('phone', 20)->nullable();
            \$table->string('email', 100)->nullable();
            \$table->text('address')->nullable();
            \$table->string('payment_terms', 50)->nullable();
            \$table->integer('lead_time_days')->default(0);
            \$table->boolean('status')->default(true);
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            
            \$table->index('organization_id');
            \$table->index('status');"
    ],
    [
        'table' => 'voucher_types',
        'schema_up' => "
            \$table->increments('id');
            \$table->unsignedBigInteger('organization_id');
            \$table->string('name', 40);
            \$table->string('prefix', 10);
            \$table->integer('start_no')->default(1);
            \$table->integer('current_no')->default(1);
            \$table->boolean('status')->default(true);
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            
            \$table->index('organization_id');
            \$table->index('status');"
    ],
    [
        'table' => 'labs',
        'schema_up' => "
            \$table->increments('id');
            \$table->unsignedInteger('branch_id');
            \$table->string('name', 100);
            \$table->string('lab_code', 20);
            \$table->enum('lab_type', ['training_lab', 'server_room', 'instructor_room', 'store_room'])->default('training_lab');
            \$table->integer('capacity')->default(0);
            \$table->string('floor', 50)->nullable();
            \$table->text('description')->nullable();
            \$table->tinyInteger('status')->default(1);
            \$table->timestamps();

            \$table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            \$table->unique(['branch_id', 'lab_code'], 'unique_lab_code');
            
            \$table->index('branch_id');
            \$table->index('status');"
    ],
    [
        'table' => 'workstations',
        'schema_up' => "
            \$table->increments('id');
            \$table->unsignedInteger('lab_id');
            \$table->string('workstation_code', 50);
            \$table->enum('workstation_type', ['student', 'instructor', 'server'])->default('student');
            \$table->enum('status', ['empty', 'occupied', 'under_repair'])->default('empty');
            \$table->text('notes')->nullable();
            \$table->timestamps();

            \$table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            \$table->unique(['lab_id', 'workstation_code'], 'unique_workstation');
            
            \$table->index('lab_id', 'idx_workstations_lab');
            \$table->index('status', 'idx_workstations_status');"
    ],
    [
        'table' => 'purchase_orders',
        'schema_up' => "
            \$table->id();
            \$table->unsignedBigInteger('organization_id');
            \$table->string('po_no', 50)->unique();
            \$table->unsignedInteger('vendor_id');
            \$table->unsignedInteger('branch_id');
            \$table->date('order_date');
            \$table->date('expected_delivery_date')->nullable();
            \$table->text('delivery_address')->nullable();
            \$table->decimal('subtotal', 12, 2)->default(0.00);
            \$table->decimal('tax_amount', 12, 2)->default(0.00);
            \$table->decimal('shipping_cost', 12, 2)->default(0.00);
            \$table->decimal('total_amount', 12, 2)->default(0.00);
            \$table->text('notes')->nullable();
            \$table->enum('status', ['draft', 'sent', 'approved', 'received', 'cancelled'])->default('draft');
            \$table->unsignedInteger('approved_by')->nullable();
            \$table->unsignedInteger('received_by')->nullable();
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            \$table->foreign('vendor_id')->references('id')->on('vendors');
            \$table->foreign('branch_id')->references('id')->on('branches');
            \$table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            \$table->foreign('received_by')->references('id')->on('users')->onDelete('set null');
            
            \$table->index('organization_id');
            \$table->index('vendor_id');
            \$table->index('branch_id');
            \$table->index('status');
            \$table->index('order_date');"
    ],
    [
        'table' => 'purchase_order_items',
        'schema_up' => "
            \$table->id();
            \$table->unsignedBigInteger('po_id');
            \$table->string('product_id', 20);
            \$table->decimal('quantity', 12, 2);
            \$table->decimal('received_quantity', 12, 2)->default(0);
            \$table->decimal('unit_price', 12, 2);
            \$table->decimal('total', 12, 2);
            \$table->string('batch_no', 50)->nullable();
            \$table->text('serial_numbers')->nullable();
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('po_id')->references('id')->on('purchase_orders')->onDelete('cascade');
            \$table->foreign('product_id')->references('id')->on('products');
            
            \$table->index('po_id');
            \$table->index('product_id');"
    ],
    [
        'table' => 'goods_receipts',
        'schema_up' => "
            \$table->id();
            \$table->unsignedBigInteger('organization_id');
            \$table->string('gr_no', 50)->unique();
            \$table->unsignedBigInteger('po_id');
            \$table->date('received_date');
            \$table->unsignedInteger('received_by');
            \$table->unsignedInteger('branch_id');
            \$table->text('notes')->nullable();
            \$table->enum('status', ['pending', 'completed'])->default('pending');
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            \$table->foreign('po_id')->references('id')->on('purchase_orders');
            \$table->foreign('received_by')->references('id')->on('users');
            \$table->foreign('branch_id')->references('id')->on('branches');
            
            \$table->index('organization_id');
            \$table->index('po_id');
            \$table->index('branch_id');
            \$table->index('status');"
    ],
    [
        'table' => 'goods_receipt_items',
        'schema_up' => "
            \$table->id();
            \$table->unsignedBigInteger('gr_id');
            \$table->string('product_id', 20);
            \$table->decimal('quantity_received', 12, 2);
            \$table->string('batch_no', 50)->nullable();
            \$table->text('serial_numbers')->nullable();
            \$table->enum('condition', ['good', 'damaged'])->default('good');
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('gr_id')->references('id')->on('goods_receipts')->onDelete('cascade');
            \$table->foreign('product_id')->references('id')->on('products');
            
            \$table->index('gr_id');
            \$table->index('product_id');"
    ],
    [
        'table' => 'requisitions',
        'schema_up' => "
            \$table->id();
            \$table->unsignedBigInteger('organization_id');
            \$table->string('req_no', 50)->unique();
            \$table->unsignedInteger('requester_branch_id');
            \$table->unsignedInteger('requested_by');
            \$table->date('requested_date');
            \$table->date('required_by_date')->nullable();
            \$table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            \$table->text('purpose')->nullable();
            \$table->enum('status', ['draft', 'pending_bm', 'pending_hr', 'pending_cfo', 'approved', 'rejected', 'fulfilled', 'cancelled'])->default('draft');
            \$table->integer('current_approval_level')->default(1);
            \$table->text('rejection_reason')->nullable();
            \$table->unsignedInteger('approved_by_bm')->nullable();
            \$table->unsignedInteger('approved_by_hr')->nullable();
            \$table->unsignedInteger('approved_by_cfo')->nullable();
            \$table->timestamp('approved_at')->nullable();
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            \$table->foreign('requester_branch_id')->references('id')->on('branches');
            \$table->foreign('requested_by')->references('id')->on('users');
            \$table->foreign('approved_by_bm')->references('id')->on('users')->onDelete('set null');
            \$table->foreign('approved_by_hr')->references('id')->on('users')->onDelete('set null');
            \$table->foreign('approved_by_cfo')->references('id')->on('users')->onDelete('set null');
            
            \$table->index('organization_id');
            \$table->index('requester_branch_id', 'idx_requisitions_branch');
            \$table->index('status', 'idx_requisitions_status');
            \$table->index('requested_date', 'idx_requisitions_date');
            \$table->index('priority', 'idx_requisitions_priority');"
    ],
    [
        'table' => 'requisition_items',
        'schema_up' => "
            \$table->id();
            \$table->unsignedBigInteger('requisition_id');
            \$table->string('product_id', 20);
            \$table->decimal('quantity_requested', 12, 2);
            \$table->decimal('quantity_approved', 12, 2)->default(0);
            \$table->decimal('quantity_issued', 12, 2)->default(0);
            \$table->decimal('unit_price_estimate', 12, 2)->nullable();
            \$table->text('notes')->nullable();
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('requisition_id')->references('id')->on('requisitions')->onDelete('cascade');
            \$table->foreign('product_id')->references('id')->on('products');
            
            \$table->index('requisition_id');
            \$table->index('product_id');"
    ],
    [
        'table' => 'stocks_transactions',
        'schema_up' => "
            \$table->increments('id');
            \$table->unsignedBigInteger('organization_id');
            \$table->string('voucher_no', 50)->unique();
            \$table->unsignedInteger('branch_from')->nullable();
            \$table->unsignedInteger('branch_to')->nullable();
            \$table->unsignedInteger('voucher_type_id');
            \$table->enum('transaction_type', ['purchase', 'transfer', 'repair', 'return', 'sales', 'adjustment']);
            \$table->date('transaction_date');
            \$table->double('standard_cost')->default(0);
            \$table->string('attachment', 255)->nullable();
            \$table->unsignedInteger('send_by')->nullable();
            \$table->unsignedInteger('received_by')->nullable();
            \$table->unsignedInteger('delivered_by')->nullable();
            \$table->text('note')->nullable();
            \$table->tinyInteger('status')->default(0);
            \$table->unsignedInteger('approved_by')->nullable();
            \$table->timestamp('approved_at')->nullable();
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            \$table->foreign('branch_from')->references('id')->on('branches')->onDelete('set null');
            \$table->foreign('branch_to')->references('id')->on('branches')->onDelete('set null');
            \$table->foreign('voucher_type_id')->references('id')->on('voucher_types');
            \$table->foreign('send_by')->references('id')->on('users')->onDelete('set null');
            \$table->foreign('received_by')->references('id')->on('users')->onDelete('set null');
            \$table->foreign('delivered_by')->references('id')->on('users')->onDelete('set null');
            \$table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            
            \$table->index('organization_id');
            \$table->index('voucher_type_id');
            \$table->index('transaction_type');
            \$table->index('voucher_no', 'idx_stocks_transactions_voucher');
            \$table->index('transaction_date', 'idx_stocks_transactions_date');
            \$table->index('status', 'idx_stocks_transactions_status');
            \$table->index('branch_from', 'idx_stocks_transactions_branch_from');
            \$table->index('branch_to', 'idx_stocks_transactions_branch_to');"
    ],
    [
        'table' => 'warehouses_zones',
        'schema_up' => "
            \$table->increments('id');
            \$table->unsignedInteger('branch_id');
            \$table->string('name', 100);
            \$table->enum('zone_type', ['primary', 'secondary', 'quarantine', 'repair'])->default('primary');
            \$table->tinyInteger('status')->default(1);
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            
            \$table->index('branch_id');
            \$table->index('status');"
    ],
    [
        'table' => 'stock_transaction_items',
        'schema_up' => "
            \$table->id();
            \$table->unsignedInteger('stock_id');
            \$table->string('product_id', 20);
            \$table->string('batch_no', 50)->nullable();
            \$table->text('serial_no')->nullable();
            \$table->decimal('price', 12, 2);
            \$table->decimal('quantity', 12, 2);
            \$table->decimal('sub_total', 12, 2);
            \$table->unsignedInteger('warehouse_zone_id')->nullable();
            \$table->tinyInteger('status')->default(1);
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('stock_id')->references('id')->on('stocks_transactions')->onDelete('cascade');
            \$table->foreign('product_id')->references('id')->on('products');
            \$table->foreign('warehouse_zone_id')->references('id')->on('warehouses_zones')->onDelete('set null');
            
            \$table->index('stock_id');
            \$table->index('product_id');
            \$table->index('warehouse_zone_id');"
    ],
    [
        'table' => 'current_stocks',
        'schema_up' => "
            \$table->id();
            \$table->unsignedInteger('branch_id');
            \$table->unsignedInteger('warehouse_zone_id')->nullable();
            \$table->string('product_id', 20);
            \$table->string('batch_no', 50)->nullable();
            \$table->decimal('quantity', 12, 2)->default(0);
            \$table->decimal('avg_price', 12, 2)->default(0);
            \$table->decimal('last_cost', 12, 2)->default(0);
            \$table->decimal('reserved_quantity', 12, 2)->default(0);
            \$table->boolean('min_stock_alert')->default(false);
            \$table->timestamp('updated_at')->nullable();

            \$table->foreign('branch_id')->references('id')->on('branches');
            \$table->foreign('warehouse_zone_id')->references('id')->on('warehouses_zones')->onDelete('set null');
            \$table->foreign('product_id')->references('id')->on('products');
            \$table->unique(['branch_id', 'product_id', 'batch_no'], 'unique_stock');
            
            \$table->index('warehouse_zone_id');
            \$table->index('branch_id', 'idx_current_stocks_branch');
            \$table->index('product_id', 'idx_current_stocks_product');
            \$table->index('batch_no', 'idx_current_stocks_batch');
            \$table->index('min_stock_alert', 'idx_current_stocks_alert');"
    ],
    [
        'table' => 'lab_stock_items',
        'schema_up' => "
            \$table->id();
            \$table->unsignedInteger('lab_id');
            \$table->string('product_id', 20);
            \$table->string('batch_no', 50)->nullable();
            \$table->decimal('quantity', 12, 2)->default(0);
            \$table->unsignedInteger('workstation_id')->nullable();
            \$table->timestamp('updated_at')->nullable();

            \$table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            \$table->foreign('product_id')->references('id')->on('products');
            \$table->foreign('workstation_id')->references('id')->on('workstations')->onDelete('set null');
            \$table->unique(['lab_id', 'product_id', 'batch_no', 'workstation_id'], 'unique_lab_product');
            
            \$table->index('workstation_id');
            \$table->index('lab_id', 'idx_lab_stock_items_lab');
            \$table->index('product_id', 'idx_lab_stock_items_product');"
    ],
    [
        'table' => 'transfers',
        'schema_up' => "
            \$table->id();
            \$table->unsignedBigInteger('organization_id');
            \$table->string('transfer_no', 50)->unique();
            \$table->unsignedInteger('from_branch_id');
            \$table->unsignedInteger('to_branch_id');
            \$table->date('transfer_date');
            \$table->unsignedInteger('requested_by');
            \$table->unsignedInteger('approved_by')->nullable();
            \$table->string('courier_name', 100)->nullable();
            \$table->string('courier_tracking_no', 100)->nullable();
            \$table->decimal('courier_cost', 12, 2)->default(0);
            \$table->unsignedInteger('received_by')->nullable();
            \$table->date('received_date')->nullable();
            \$table->enum('status', ['pending', 'approved', 'in_transit', 'received', 'cancelled'])->default('pending');
            \$table->text('notes')->nullable();
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            \$table->foreign('from_branch_id')->references('id')->on('branches');
            \$table->foreign('to_branch_id')->references('id')->on('branches');
            \$table->foreign('requested_by')->references('id')->on('users');
            \$table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            \$table->foreign('received_by')->references('id')->on('users')->onDelete('set null');
            
            \$table->index('organization_id');
            \$table->index('from_branch_id', 'idx_transfers_from_branch');
            \$table->index('to_branch_id', 'idx_transfers_to_branch');
            \$table->index('status', 'idx_transfers_status');
            \$table->index('courier_tracking_no', 'idx_transfers_tracking');"
    ],
    [
        'table' => 'transfer_items',
        'schema_up' => "
            \$table->id();
            \$table->unsignedBigInteger('transfer_id');
            \$table->string('product_id', 20);
            \$table->decimal('quantity', 12, 2);
            \$table->string('batch_no', 50)->nullable();
            \$table->text('serial_numbers')->nullable();
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('transfer_id')->references('id')->on('transfers')->onDelete('cascade');
            \$table->foreign('product_id')->references('id')->on('products');
            
            \$table->index('transfer_id');
            \$table->index('product_id');"
    ],
    [
        'table' => 'repairs',
        'schema_up' => "
            \$table->id();
            \$table->unsignedBigInteger('organization_id');
            \$table->string('repair_no', 50)->unique();
            \$table->string('product_id', 20);
            \$table->unsignedInteger('from_branch_id');
            \$table->string('batch_no', 50)->nullable();
            \$table->string('serial_no', 100)->nullable();
            \$table->text('fault_description')->nullable();
            \$table->date('received_at_head_office')->nullable();
            \$table->string('repaired_by', 100)->nullable();
            \$table->decimal('repair_cost', 12, 2)->default(0);
            \$table->date('repaired_date')->nullable();
            \$table->date('sent_back_to_branch')->nullable();
            \$table->string('courier_tracking_no', 100)->nullable();
            \$table->text('notes')->nullable();
            \$table->enum('status', ['pending_receipt', 'in_repair', 'repaired', 'returned', 'beyond_repair'])->default('pending_receipt');
            \$table->unsignedInteger('created_by');
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            \$table->foreign('product_id')->references('id')->on('products');
            \$table->foreign('from_branch_id')->references('id')->on('branches');
            \$table->foreign('created_by')->references('id')->on('users');
            
            \$table->index('organization_id');
            \$table->index('from_branch_id', 'idx_repairs_branch');
            \$table->index('product_id', 'idx_repairs_product');
            \$table->index('status', 'idx_repairs_status');
            \$table->index('serial_no', 'idx_repairs_serial');"
    ],
    [
        'table' => 'issues',
        'schema_up' => "
            \$table->id();
            \$table->unsignedBigInteger('organization_id');
            \$table->string('issue_no', 50)->unique();
            \$table->unsignedBigInteger('requisition_id')->nullable();
            \$table->unsignedInteger('from_branch_id');
            \$table->unsignedInteger('to_branch_id');
            \$table->unsignedInteger('issued_by');
            \$table->date('issued_date');
            \$table->unsignedInteger('received_by')->nullable();
            \$table->enum('issue_type', ['store_issue', 'transfer_out', 'repair_send', 'return_to_vendor'])->default('store_issue');
            \$table->string('courier_name', 100)->nullable();
            \$table->string('courier_tracking_no', 100)->nullable();
            \$table->text('notes')->nullable();
            \$table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            \$table->foreign('requisition_id')->references('id')->on('requisitions')->onDelete('set null');
            \$table->foreign('from_branch_id')->references('id')->on('branches');
            \$table->foreign('to_branch_id')->references('id')->on('branches');
            \$table->foreign('issued_by')->references('id')->on('users');
            \$table->foreign('received_by')->references('id')->on('users')->onDelete('set null');
            
            \$table->index('organization_id');
            \$table->index('requisition_id');
            \$table->index('from_branch_id');
            \$table->index('to_branch_id');
            \$table->index('status');
            \$table->index('issue_type');"
    ],
    [
        'table' => 'issue_items',
        'schema_up' => "
            \$table->id();
            \$table->unsignedBigInteger('issue_id');
            \$table->string('product_id', 20);
            \$table->decimal('quantity', 12, 2);
            \$table->string('batch_no', 50)->nullable();
            \$table->text('serial_numbers')->nullable();
            \$table->decimal('unit_price', 12, 2)->nullable();
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('issue_id')->references('id')->on('issues')->onDelete('cascade');
            \$table->foreign('product_id')->references('id')->on('products');
            
            \$table->index('issue_id');
            \$table->index('product_id');"
    ],
    [
        'table' => 'asset_assignments',
        'schema_up' => "
            \$table->id();
            \$table->string('product_id', 20);
            \$table->string('serial_no', 100);
            \$table->unsignedInteger('branch_id');
            \$table->unsignedInteger('lab_id')->nullable();
            \$table->unsignedInteger('workstation_id')->nullable();
            \$table->unsignedInteger('assigned_to_user_id');
            \$table->unsignedInteger('assigned_by');
            \$table->date('assigned_date');
            \$table->date('return_date')->nullable();
            \$table->enum('assignment_type', ['permanent', 'temporary', 'lab_assigned'])->default('permanent');
            \$table->enum('condition', ['good', 'damaged', 'under_repair'])->default('good');
            \$table->text('notes')->nullable();
            \$table->enum('status', ['assigned', 'returned', 'lost', 'disposed'])->default('assigned');
            \$table->timestamps();

            \$table->foreign('product_id')->references('id')->on('products');
            \$table->foreign('branch_id')->references('id')->on('branches');
            \$table->foreign('lab_id')->references('id')->on('labs')->onDelete('set null');
            \$table->foreign('workstation_id')->references('id')->on('workstations')->onDelete('set null');
            \$table->foreign('assigned_to_user_id')->references('id')->on('users');
            \$table->foreign('assigned_by')->references('id')->on('users');
            
            \$table->index('lab_id');
            \$table->index('workstation_id');
            \$table->index('product_id', 'idx_asset_assignments_product');
            \$table->index('branch_id', 'idx_asset_assignments_branch');
            \$table->index('assigned_to_user_id', 'idx_asset_assignments_user');
            \$table->index('serial_no', 'idx_asset_assignments_serial');
            \$table->index('status', 'idx_asset_assignments_status');"
    ],
    [
        'table' => 'stock_adjustments',
        'schema_up' => "
            \$table->id();
            \$table->unsignedBigInteger('organization_id');
            \$table->unsignedInteger('branch_id');
            \$table->date('adjustment_date');
            \$table->enum('adjustment_type', ['increase', 'decrease']);
            \$table->text('reason')->nullable();
            \$table->string('reference_no', 50)->nullable();
            \$table->unsignedInteger('approved_by')->nullable();
            \$table->enum('status', ['draft', 'approved'])->default('draft');
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            \$table->foreign('branch_id')->references('id')->on('branches');
            \$table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            
            \$table->index('organization_id');
            \$table->index('branch_id');
            \$table->index('status');
            \$table->index('adjustment_date');"
    ],
    [
        'table' => 'stock_adjustment_items',
        'schema_up' => "
            \$table->id();
            \$table->unsignedBigInteger('adjustment_id');
            \$table->string('product_id', 20);
            \$table->string('batch_no', 50)->nullable();
            \$table->decimal('quantity', 12, 2);
            \$table->decimal('unit_cost', 12, 2)->nullable();
            \$table->text('note')->nullable();
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('adjustment_id')->references('id')->on('stock_adjustments')->onDelete('cascade');
            \$table->foreign('product_id')->references('id')->on('products');
            
            \$table->index('adjustment_id');
            \$table->index('product_id');"
    ],
    [
        'table' => 'stock_reservations',
        'schema_up' => "
            \$table->id();
            \$table->unsignedInteger('branch_id');
            \$table->string('product_id', 20);
            \$table->string('batch_no', 50)->nullable();
            \$table->decimal('reserved_quantity', 12, 2);
            \$table->string('reference_type', 50)->nullable();
            \$table->bigInteger('reference_id')->nullable();
            \$table->dateTime('reserved_until')->nullable();
            \$table->enum('status', ['active', 'consumed', 'released'])->default('active');
            \$table->timestamps();

            \$table->foreign('branch_id')->references('id')->on('branches');
            \$table->foreign('product_id')->references('id')->on('products');
            
            \$table->index('branch_id');
            \$table->index('product_id');
            \$table->index('status');"
    ],
    [
        'table' => 'stock_movements',
        'schema_up' => "
            \$table->id();
            \$table->string('product_id', 20);
            \$table->unsignedInteger('branch_id');
            \$table->string('batch_no', 50)->nullable();
            \$table->decimal('quantity_change', 12, 2);
            \$table->decimal('new_quantity', 12, 2);
            \$table->enum('reference_type', ['purchase', 'transfer', 'issue', 'repair', 'adjustment', 'requisition_fulfillment', 'sales']);
            \$table->bigInteger('reference_id');
            \$table->decimal('previous_avg_price', 12, 2)->nullable();
            \$table->decimal('new_avg_price', 12, 2)->nullable();
            \$table->timestamp('created_at')->nullable();
            \$table->unsignedInteger('created_by');

            \$table->foreign('product_id')->references('id')->on('products');
            \$table->foreign('branch_id')->references('id')->on('branches');
            \$table->foreign('created_by')->references('id')->on('users');
            
            \$table->index('product_id', 'idx_stock_movements_product');
            \$table->index('branch_id', 'idx_stock_movements_branch');
            \$table->index('created_at', 'idx_stock_movements_date');
            \$table->index(['reference_type', 'reference_id'], 'idx_stock_movements_reference');"
    ],
    [
        'table' => 'supplier_products',
        'schema_up' => "
            \$table->id();
            \$table->unsignedInteger('supplier_id');
            \$table->string('product_id', 20);
            \$table->decimal('price', 12, 2);
            \$table->string('suppliers_uom', 50)->nullable();
            \$table->double('conversion_factor')->default(1);
            \$table->string('supplier_description', 50)->nullable();
            \$table->integer('lead_time_days')->default(0);
            \$table->boolean('is_preferred')->default(false);
            \$table->timestamps();

            \$table->foreign('supplier_id')->references('id')->on('vendors');
            \$table->foreign('product_id')->references('id')->on('products');
            \$table->unique(['supplier_id', 'product_id'], 'unique_supplier_product');
            
            \$table->index('supplier_id');
            \$table->index('product_id');"
    ],
    [
        'table' => 'approval_logs',
        'schema_up' => "
            \$table->id();
            \$table->string('reference_type', 50);
            \$table->bigInteger('reference_id');
            \$table->unsignedInteger('approver_id');
            \$table->integer('approval_level');
            \$table->enum('action', ['approved', 'rejected', 'forwarded']);
            \$table->text('comments')->nullable();
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('approver_id')->references('id')->on('users');
            
            \$table->index('reference_type');
            \$table->index('reference_id');
            \$table->index('approver_id');"
    ],
    [
        'table' => 'notifications',
        'schema_up' => "
            \$table->id();
            \$table->unsignedInteger('user_id');
            \$table->string('title', 200);
            \$table->text('message');
            \$table->enum('type', ['alert', 'approval', 'info', 'reminder'])->default('info');
            \$table->string('reference_type', 50)->nullable();
            \$table->bigInteger('reference_id')->nullable();
            \$table->boolean('is_read')->default(false);
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            \$table->index('user_id');
            \$table->index('is_read');
            \$table->index('reference_type');
            \$table->index('reference_id');"
    ],
    [
        'table' => 'settings',
        'schema_up' => "
            \$table->increments('id');
            \$table->unsignedBigInteger('organization_id');
            \$table->string('setting_key', 100);
            \$table->text('setting_value')->nullable();
            \$table->enum('setting_type', ['text', 'number', 'boolean', 'json'])->default('text');
            \$table->timestamps();

            \$table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            \$table->unique(['organization_id', 'setting_key'], 'unique_setting');
            
            \$table->index('organization_id');"
    ],
    [
        'table' => 'backup_logs',
        'schema_up' => "
            \$table->id();
            \$table->dateTime('backup_date');
            \$table->enum('backup_type', ['auto', 'manual'])->default('auto');
            \$table->string('file_name', 255)->nullable();
            \$table->bigInteger('file_size')->nullable();
            \$table->enum('status', ['success', 'failed'])->default('success');
            \$table->text('error_message')->nullable();
            \$table->unsignedInteger('created_by')->nullable();
            \$table->timestamp('created_at')->nullable();

            \$table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            
            \$table->index('status');
            \$table->index('backup_date');"
    ]
];

$base_time = time() - (count($migrations) * 5); // Ensure all timestamps are sequential and slightly in the past
$dir = __DIR__ . '/database/migrations/';

foreach ($migrations as $i => $mig) {
    $table = $mig['table'];
    // Increment timestamp by 1 second for each file so they run in order
    $timestamp = date('Y_m_d_His', $base_time + $i);
    $filename = $dir . $timestamp . '_create_' . $table . '_table.php';

    $template = "<?php\n\nuse Illuminate\Database\Migrations\Migration;\nuse Illuminate\Database\Schema\Blueprint;\nuse Illuminate\Support\Facades\Schema;\n\nreturn new class extends Migration\n{\n    /**\n     * Run the migrations.\n     */\n    public function up(): void\n    {\n        Schema::create('{$table}', function (Blueprint \$table) {{$mig['schema_up']}\n        });\n    }\n\n    /**\n     * Reverse the migrations.\n     */\n    public function down(): void\n    {\n        Schema::dropIfExists('{$table}');\n    }\n};\n";

    file_put_contents($filename, $template);
}
echo "Generated " . count($migrations) . " individual migration files with comprehensive indexing.\n";
