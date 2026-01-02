<?php
// database/migrations/2024_xx_xx_000001_add_fields_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'kontributor', 'user'])->default('user')->after('email');
            $table->string('avatar')->nullable()->after('password');
            $table->string('employee_id')->unique()->nullable()->after('avatar');
            $table->boolean('is_active')->default(true)->after('employee_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'avatar', 'employee_id', 'is_active']);
        });
    }
};