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
        Schema::create('stocks_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('organization_id');
            $table->string('voucher_no', 50)->unique();
            $table->unsignedInteger('branch_from')->nullable();
            $table->unsignedInteger('branch_to')->nullable();
            $table->unsignedInteger('voucher_type_id');
            $table->enum('transaction_type', ['purchase', 'transfer', 'repair', 'return', 'sales', 'adjustment']);
            $table->date('transaction_date');
            $table->double('standard_cost')->default(0);
            $table->string('attachment', 255)->nullable();
            $table->unsignedInteger('send_by')->nullable();
            $table->unsignedInteger('received_by')->nullable();
            $table->unsignedInteger('delivered_by')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('branch_from')->references('id')->on('branches')->onDelete('set null');
            $table->foreign('branch_to')->references('id')->on('branches')->onDelete('set null');
            $table->foreign('voucher_type_id')->references('id')->on('voucher_types');
            $table->foreign('send_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('received_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('delivered_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            
            $table->index('organization_id');
            $table->index('voucher_type_id');
            $table->index('transaction_type');
            $table->index('voucher_no', 'idx_stocks_transactions_voucher');
            $table->index('transaction_date', 'idx_stocks_transactions_date');
            $table->index('status', 'idx_stocks_transactions_status');
            $table->index('branch_from', 'idx_stocks_transactions_branch_from');
            $table->index('branch_to', 'idx_stocks_transactions_branch_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks_transactions');
    }
};
