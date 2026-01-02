<?php
// database/migrations/2024_xx_xx_000005_create_lesson_attachments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesson_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_id');
            $table->string('file_name');
            $table->string('file_path', 500);
            $table->string('file_type', 50);
            $table->bigInteger('file_size')->comment('dalam bytes');
            $table->timestamp('created_at')->useCurrent();
            
            $table->index('lesson_id');
            
            // Foreign key
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_attachments');
    }
};