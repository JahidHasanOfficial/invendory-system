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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->string('repair_no', 50)->unique();
            $table->string('product_id', 20);
            $table->unsignedInteger('from_branch_id');
            $table->string('batch_no', 50)->nullable();
            $table->string('serial_no', 100)->nullable();
            $table->text('fault_description')->nullable();
            $table->date('received_at_head_office')->nullable();
            $table->string('repaired_by', 100)->nullable();
            $table->decimal('repair_cost', 12, 2)->default(0);
            $table->date('repaired_date')->nullable();
            $table->date('sent_back_to_branch')->nullable();
            $table->string('courier_tracking_no', 100)->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending_receipt', 'in_repair', 'repaired', 'returned', 'beyond_repair'])->default('pending_receipt');
            $table->unsignedInteger('created_by');
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('from_branch_id')->references('id')->on('branches');
            $table->foreign('created_by')->references('id')->on('users');
            
            $table->index('organization_id');
            $table->index('from_branch_id', 'idx_repairs_branch');
            $table->index('product_id', 'idx_repairs_product');
            $table->index('status', 'idx_repairs_status');
            $table->index('serial_no', 'idx_repairs_serial');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
