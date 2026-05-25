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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->string('transfer_no', 50)->unique();
            $table->unsignedInteger('from_branch_id');
            $table->unsignedInteger('to_branch_id');
            $table->date('transfer_date');
            $table->unsignedInteger('requested_by');
            $table->unsignedInteger('approved_by')->nullable();
            $table->string('courier_name', 100)->nullable();
            $table->string('courier_tracking_no', 100)->nullable();
            $table->decimal('courier_cost', 12, 2)->default(0);
            $table->unsignedInteger('received_by')->nullable();
            $table->date('received_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'in_transit', 'received', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('from_branch_id')->references('id')->on('branches');
            $table->foreign('to_branch_id')->references('id')->on('branches');
            $table->foreign('requested_by')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('received_by')->references('id')->on('users')->onDelete('set null');
            
            $table->index('organization_id');
            $table->index('from_branch_id', 'idx_transfers_from_branch');
            $table->index('to_branch_id', 'idx_transfers_to_branch');
            $table->index('status', 'idx_transfers_status');
            $table->index('courier_tracking_no', 'idx_transfers_tracking');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
