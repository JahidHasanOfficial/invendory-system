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
        Schema::create('issue_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('issue_id');
            $table->string('product_id', 20);
            $table->decimal('quantity', 12, 2);
            $table->string('batch_no', 50)->nullable();
            $table->text('serial_numbers')->nullable();
            $table->decimal('unit_price', 12, 2)->nullable();
            $table->timestamp('created_at')->nullable();

            $table->foreign('issue_id')->references('id')->on('issues')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
            
            $table->index('issue_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_items');
    }
};
