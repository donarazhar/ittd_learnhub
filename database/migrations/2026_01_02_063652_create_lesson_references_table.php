<?php
// database/migrations/2024_xx_xx_000006_create_lesson_references_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesson_references', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_id');
            $table->string('title');
            $table->string('url', 500);
            $table->enum('type', ['book', 'article', 'video', 'website'])->default('website');
            $table->integer('order')->default(0);
            $table->timestamp('created_at')->useCurrent();
            
            $table->index('lesson_id');
            
            // Foreign key
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_references');
    }
};