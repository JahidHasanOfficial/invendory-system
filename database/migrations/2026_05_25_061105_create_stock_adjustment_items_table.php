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
        Schema::create('stock_adjustment_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('adjustment_id');
            $table->string('product_id', 20);
            $table->string('batch_no', 50)->nullable();
            $table->decimal('quantity', 12, 2);
            $table->decimal('unit_cost', 12, 2)->nullable();
            $table->text('note')->nullable();
            $table->timestamp('created_at')->nullable();

            $table->foreign('adjustment_id')->references('id')->on('stock_adjustments')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
            
            $table->index('adjustment_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustment_items');
    }
};
