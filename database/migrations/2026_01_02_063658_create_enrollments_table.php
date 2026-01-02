<?php
// database/migrations/2024_xx_xx_000007_create_enrollments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->timestamp('enrolled_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();
            $table->decimal('progress_percentage', 5, 2)->default(0.00);
            $table->unsignedBigInteger('last_accessed_lesson_id')->nullable();
            
            $table->unique(['user_id', 'course_id']);
            $table->index('user_id');
            $table->index('course_id');
            
            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('last_accessed_lesson_id')->references('id')->on('lessons')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};