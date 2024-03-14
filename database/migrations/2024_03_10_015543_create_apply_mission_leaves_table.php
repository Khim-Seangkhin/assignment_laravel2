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
        Schema::create('apply_mission_leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('mission_leave_request');
            $table->string('approver');
            $table->string('submit_mission_leave')->nullable();
            $table->string('approve_reject')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apply_mission_leaves');
    }
};
