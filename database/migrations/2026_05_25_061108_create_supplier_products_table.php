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
        Schema::create('supplier_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('supplier_id');
            $table->string('product_id', 20);
            $table->decimal('price', 12, 2);
            $table->string('suppliers_uom', 50)->nullable();
            $table->double('conversion_factor')->default(1);
            $table->string('supplier_description', 50)->nullable();
            $table->integer('lead_time_days')->default(0);
            $table->boolean('is_preferred')->default(false);
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('vendors');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unique(['supplier_id', 'product_id'], 'unique_supplier_product');
            
            $table->index('supplier_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_products');
    }
};
