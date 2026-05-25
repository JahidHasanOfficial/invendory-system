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
        Schema::create('products', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('brand_id')->nullable();
            $table->string('name', 200);
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->decimal('purchase_price', 12, 2)->default(0.00);
            $table->integer('reorder_level')->default(0);
            $table->unsignedInteger('unit_id')->nullable();
            $table->string('model', 100)->nullable();
            $table->string('barcode', 50)->unique()->nullable();
            $table->string('sku', 50)->unique()->nullable();
            $table->string('image', 255)->nullable();
            $table->decimal('weight', 10, 3)->default(0.000);
            $table->boolean('is_batch_tracked')->default(false);
            $table->boolean('is_serial_tracked')->default(false);
            $table->boolean('is_asset')->default(false);
            $table->integer('warranty_period_months')->default(0);
            $table->decimal('min_stock', 12, 2)->default(0);
            $table->decimal('max_stock', 12, 2)->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('set null');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('set null');
            
            $table->index('organization_id', 'idx_products_organization');
            $table->index('category_id', 'idx_products_category');
            $table->index('brand_id', 'idx_products_brand');
            $table->index('unit_id');
            $table->index('status', 'idx_products_status');
            $table->index('sku', 'idx_products_sku');
            $table->index('barcode', 'idx_products_barcode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
