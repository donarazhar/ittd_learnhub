<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
                'avatar' => 'avatars/admin.jpg',
                'employee_id' => 'EMP001',
                'is_active' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Contributor',
                'email' => 'contributor@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'kontributor',
                'avatar' => 'avatars/contributor.jpg',
                'employee_id' => 'EMP002',
                'is_active' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'avatars/jane.jpg',
                'employee_id' => 'EMP003',
                'is_active' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => null,
                'employee_id' => 'EMP004',
                'is_active' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'avatar' => 'avatars/alice.jpg',
                'employee_id' => 'EMP005',
                'is_active' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}