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
        Schema::create('goods_receipt_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gr_id');
            $table->string('product_id', 20);
            $table->decimal('quantity_received', 12, 2);
            $table->string('batch_no', 50)->nullable();
            $table->text('serial_numbers')->nullable();
            $table->enum('condition', ['good', 'damaged'])->default('good');
            $table->timestamp('created_at')->nullable();

            $table->foreign('gr_id')->references('id')->on('goods_receipts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
            
            $table->index('gr_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_receipt_items');
    }
};
