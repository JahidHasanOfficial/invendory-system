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
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedInteger('branch_id');
            $table->date('adjustment_date');
            $table->enum('adjustment_type', ['increase', 'decrease']);
            $table->text('reason')->nullable();
            $table->string('reference_no', 50)->nullable();
            $table->unsignedInteger('approved_by')->nullable();
            $table->enum('status', ['draft', 'approved'])->default('draft');
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            
            $table->index('organization_id');
            $table->index('branch_id');
            $table->index('status');
            $table->index('adjustment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustments');
    }
};
