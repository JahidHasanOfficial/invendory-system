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
        Schema::create('lab_stock_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('lab_id');
            $table->string('product_id', 20);
            $table->string('batch_no', 50)->nullable();
            $table->decimal('quantity', 12, 2)->default(0);
            $table->unsignedInteger('workstation_id')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('workstation_id')->references('id')->on('workstations')->onDelete('set null');
            $table->unique(['lab_id', 'product_id', 'batch_no', 'workstation_id'], 'unique_lab_product');
            
            $table->index('workstation_id');
            $table->index('lab_id', 'idx_lab_stock_items_lab');
            $table->index('product_id', 'idx_lab_stock_items_product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_stock_items');
    }
};
