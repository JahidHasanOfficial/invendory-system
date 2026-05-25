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
        Schema::create('workstations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lab_id');
            $table->string('workstation_code', 50);
            $table->enum('workstation_type', ['student', 'instructor', 'server'])->default('student');
            $table->enum('status', ['empty', 'occupied', 'under_repair'])->default('empty');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->unique(['lab_id', 'workstation_code'], 'unique_workstation');
            
            $table->index('lab_id', 'idx_workstations_lab');
            $table->index('status', 'idx_workstations_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workstations');
    }
};
