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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->string('req_no', 50)->unique();
            $table->unsignedInteger('requester_branch_id');
            $table->unsignedInteger('requested_by');
            $table->date('requested_date');
            $table->date('required_by_date')->nullable();
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->text('purpose')->nullable();
            $table->enum('status', ['draft', 'pending_bm', 'pending_hr', 'pending_cfo', 'approved', 'rejected', 'fulfilled', 'cancelled'])->default('draft');
            $table->integer('current_approval_level')->default(1);
            $table->text('rejection_reason')->nullable();
            $table->unsignedInteger('approved_by_bm')->nullable();
            $table->unsignedInteger('approved_by_hr')->nullable();
            $table->unsignedInteger('approved_by_cfo')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('requester_branch_id')->references('id')->on('branches');
            $table->foreign('requested_by')->references('id')->on('users');
            $table->foreign('approved_by_bm')->references('id')->on('users')->onDelete('set null');
            $table->foreign('approved_by_hr')->references('id')->on('users')->onDelete('set null');
            $table->foreign('approved_by_cfo')->references('id')->on('users')->onDelete('set null');
            
            $table->index('organization_id');
            $table->index('requester_branch_id', 'idx_requisitions_branch');
            $table->index('status', 'idx_requisitions_status');
            $table->index('requested_date', 'idx_requisitions_date');
            $table->index('priority', 'idx_requisitions_priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};
