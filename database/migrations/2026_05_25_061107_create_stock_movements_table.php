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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->string('product_id', 20);
            $table->unsignedInteger('branch_id');
            $table->string('batch_no', 50)->nullable();
            $table->decimal('quantity_change', 12, 2);
            $table->decimal('new_quantity', 12, 2);
            $table->enum('reference_type', ['purchase', 'transfer', 'issue', 'repair', 'adjustment', 'requisition_fulfillment', 'sales']);
            $table->bigInteger('reference_id');
            $table->decimal('previous_avg_price', 12, 2)->nullable();
            $table->decimal('new_avg_price', 12, 2)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->unsignedInteger('created_by');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('created_by')->references('id')->on('users');
            
            $table->index('product_id', 'idx_stock_movements_product');
            $table->index('branch_id', 'idx_stock_movements_branch');
            $table->index('created_at', 'idx_stock_movements_date');
            $table->index(['reference_type', 'reference_id'], 'idx_stock_movements_reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
