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
        Schema::create('goods_receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->string('gr_no', 50)->unique();
            $table->unsignedBigInteger('po_id');
            $table->date('received_date');
            $table->unsignedInteger('received_by');
            $table->unsignedInteger('branch_id');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->timestamp('created_at')->nullable();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('po_id')->references('id')->on('purchase_orders');
            $table->foreign('received_by')->references('id')->on('users');
            $table->foreign('branch_id')->references('id')->on('branches');
            
            $table->index('organization_id');
            $table->index('po_id');
            $table->index('branch_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_receipts');
    }
};
