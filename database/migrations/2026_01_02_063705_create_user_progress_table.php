<?php
// database/migrations/2024_xx_xx_000008_create_user_progress_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lesson_id');
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->integer('last_position')->default(0)->comment('video position dalam detik');
            $table->timestamps();
            
            $table->unique(['user_id', 'lesson_id']);
            $table->index('user_id');
            $table->index('lesson_id');
            
            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};