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
        Schema::create('asset_assignments', function (Blueprint $table) {
            $table->id();
            $table->string('product_id', 20);
            $table->string('serial_no', 100);
            $table->unsignedInteger('branch_id');
            $table->unsignedInteger('lab_id')->nullable();
            $table->unsignedInteger('workstation_id')->nullable();
            $table->unsignedInteger('assigned_to_user_id');
            $table->unsignedInteger('assigned_by');
            $table->date('assigned_date');
            $table->date('return_date')->nullable();
            $table->enum('assignment_type', ['permanent', 'temporary', 'lab_assigned'])->default('permanent');
            $table->enum('condition', ['good', 'damaged', 'under_repair'])->default('good');
            $table->text('notes')->nullable();
            $table->enum('status', ['assigned', 'returned', 'lost', 'disposed'])->default('assigned');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('set null');
            $table->foreign('workstation_id')->references('id')->on('workstations')->onDelete('set null');
            $table->foreign('assigned_to_user_id')->references('id')->on('users');
            $table->foreign('assigned_by')->references('id')->on('users');
            
            $table->index('lab_id');
            $table->index('workstation_id');
            $table->index('product_id', 'idx_asset_assignments_product');
            $table->index('branch_id', 'idx_asset_assignments_branch');
            $table->index('assigned_to_user_id', 'idx_asset_assignments_user');
            $table->index('serial_no', 'idx_asset_assignments_serial');
            $table->index('status', 'idx_asset_assignments_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_assignments');
    }
};
