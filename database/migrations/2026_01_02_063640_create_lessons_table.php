<?php
// database/migrations/2024_xx_xx_000004_create_lessons_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->string('title');
            $table->string('slug');
            $table->longText('content')->nullable();
            $table->string('video_url', 500)->nullable()->comment('YouTube embed URL');
            $table->integer('video_duration')->nullable()->comment('dalam detik');
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->index(['module_id', 'order']);
            $table->index('slug');
            
            // Foreign key
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};