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
        Schema::create('stock_transaction_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('stock_id');
            $table->string('product_id', 20);
            $table->string('batch_no', 50)->nullable();
            $table->text('serial_no')->nullable();
            $table->decimal('price', 12, 2);
            $table->decimal('quantity', 12, 2);
            $table->decimal('sub_total', 12, 2);
            $table->unsignedInteger('warehouse_zone_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamp('created_at')->nullable();

            $table->foreign('stock_id')->references('id')->on('stocks_transactions')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('warehouse_zone_id')->references('id')->on('warehouses_zones')->onDelete('set null');
            
            $table->index('stock_id');
            $table->index('product_id');
            $table->index('warehouse_zone_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transaction_items');
    }
};
