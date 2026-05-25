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
        Schema::create('backup_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('backup_date');
            $table->enum('backup_type', ['auto', 'manual'])->default('auto');
            $table->string('file_name', 255)->nullable();
            $table->bigInteger('file_size')->nullable();
            $table->enum('status', ['success', 'failed'])->default('success');
            $table->text('error_message')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->timestamp('created_at')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            
            $table->index('status');
            $table->index('backup_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_logs');
    }
};
