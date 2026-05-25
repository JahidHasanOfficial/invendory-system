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
        Schema::create('approval_logs', function (Blueprint $table) {
            $table->id();
            $table->string('reference_type', 50);
            $table->bigInteger('reference_id');
            $table->unsignedInteger('approver_id');
            $table->integer('approval_level');
            $table->enum('action', ['approved', 'rejected', 'forwarded']);
            $table->text('comments')->nullable();
            $table->timestamp('created_at')->nullable();

            $table->foreign('approver_id')->references('id')->on('users');
            
            $table->index('reference_type');
            $table->index('reference_id');
            $table->index('approver_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_logs');
    }
};
