<?php
// database/migrations/2024_xx_xx_000012_create_course_reviews_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('rating')->unsigned()->comment('1-5');
            $table->text('review')->nullable();
            $table->timestamps();
            
            $table->unique(['course_id', 'user_id']);
            $table->index('course_id');
            $table->index('rating');
            
            // Foreign keys
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_reviews');
    }
};