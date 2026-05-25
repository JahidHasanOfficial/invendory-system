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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->string('issue_no', 50)->unique();
            $table->unsignedBigInteger('requisition_id')->nullable();
            $table->unsignedInteger('from_branch_id');
            $table->unsignedInteger('to_branch_id');
            $table->unsignedInteger('issued_by');
            $table->date('issued_date');
            $table->unsignedInteger('received_by')->nullable();
            $table->enum('issue_type', ['store_issue', 'transfer_out', 'repair_send', 'return_to_vendor'])->default('store_issue');
            $table->string('courier_name', 100)->nullable();
            $table->string('courier_tracking_no', 100)->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('requisition_id')->references('id')->on('requisitions')->onDelete('set null');
            $table->foreign('from_branch_id')->references('id')->on('branches');
            $table->foreign('to_branch_id')->references('id')->on('branches');
            $table->foreign('issued_by')->references('id')->on('users');
            $table->foreign('received_by')->references('id')->on('users')->onDelete('set null');
            
            $table->index('organization_id');
            $table->index('requisition_id');
            $table->index('from_branch_id');
            $table->index('to_branch_id');
            $table->index('status');
            $table->index('issue_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
