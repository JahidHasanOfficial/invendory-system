<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('current_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('branch_id');
            $table->unsignedInteger('warehouse_zone_id')->nullable();
            $table->string('product_id', 20);
            $table->string('batch_no', 50)->nullable();
            $table->decimal('quantity', 12, 2)->default(0);
            $table->decimal('avg_price', 12, 2)->default(0);
            $table->decimal('last_cost', 12, 2)->default(0);
            $table->decimal('reserved_quantity', 12, 2)->default(0);
            $table->boolean('min_stock_alert')->default(false);
            $table->timestamp('updated_at')->nullable();

            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('warehouse_zone_id')->references('id')->on('warehouses_zones')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unique(['branch_id', 'product_id', 'batch_no'], 'unique_stock');
            
            $table->index('warehouse_zone_id');
            $table->index('branch_id', 'idx_current_stocks_branch');
            $table->index('product_id', 'idx_current_stocks_product');
            $table->index('batch_no', 'idx_current_stocks_batch');
            $table->index('min_stock_alert', 'idx_current_stocks_alert');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_stocks');
    }
};
