<?php
// database/migrations/2024_xx_xx_000013_create_user_activities_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('activity_type', 50)->comment('course_enrolled, lesson_completed, etc');
            $table->json('activity_data')->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            $table->index('user_id');
            $table->index('activity_type');
            $table->index('created_at');
            
            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};