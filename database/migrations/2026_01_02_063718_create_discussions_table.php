<?php
// database/migrations/2024_xx_xx_000010_create_discussions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('content');
            $table->boolean('is_pinned')->default(false);
            $table->integer('replies_count')->default(0);
            $table->timestamps();
            
            $table->index('lesson_id');
            $table->index('user_id');
            $table->index('is_pinned');
            
            // Foreign keys
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discussions');
    }
};