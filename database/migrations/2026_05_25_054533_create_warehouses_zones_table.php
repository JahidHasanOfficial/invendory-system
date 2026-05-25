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
        Schema::create('warehouses_zones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('branch_id');
            $table->string('name', 100);
            $table->enum('zone_type', ['primary', 'secondary', 'quarantine', 'repair'])->default('primary');
            $table->tinyInteger('status')->default(1);
            $table->timestamp('created_at')->nullable();

            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            
            $table->index('branch_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses_zones');
    }
};
