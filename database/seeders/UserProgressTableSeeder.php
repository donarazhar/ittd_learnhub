<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProgressTableSeeder extends Seeder
{
    public function run(): void
    {
        $progress = [
            // User 3 (Jane) - Completed Laravel Fundamental
            ['user_id' => 3, 'lesson_id' => 1, 'is_completed' => true, 'completed_at' => now()->subDays(24), 'last_position' => 900, 'created_at' => now()->subDays(24), 'updated_at' => now()->subDays(24)],
            ['user_id' => 3, 'lesson_id' => 2, 'is_completed' => true, 'completed_at' => now()->subDays(23), 'last_position' => 720, 'created_at' => now()->subDays(23), 'updated_at' => now()->subDays(23)],
            ['user_id' => 3, 'lesson_id' => 3, 'is_completed' => true, 'completed_at' => now()->subDays(22), 'last_position' => 0, 'created_at' => now()->subDays(22), 'updated_at' => now()->subDays(22)],
            ['user_id' => 3, 'lesson_id' => 4, 'is_completed' => true, 'completed_at' => now()->subDays(20), 'last_position' => 840, 'created_at' => now()->subDays(20), 'updated_at' => now()->subDays(20)],
            ['user_id' => 3, 'lesson_id' => 5, 'is_completed' => true, 'completed_at' => now()->subDays(19), 'last_position' => 660, 'created_at' => now()->subDays(19), 'updated_at' => now()->subDays(19)],
            ['user_id' => 3, 'lesson_id' => 6, 'is_completed' => true, 'completed_at' => now()->subDays(18), 'last_position' => 1020, 'created_at' => now()->subDays(18), 'updated_at' => now()->subDays(18)],
            ['user_id' => 3, 'lesson_id' => 7, 'is_completed' => true, 'completed_at' => now()->subDays(16), 'last_position' => 0, 'created_at' => now()->subDays(16), 'updated_at' => now()->subDays(16)],
            ['user_id' => 3, 'lesson_id' => 8, 'is_completed' => true, 'completed_at' => now()->subDays(15), 'last_position' => 960, 'created_at' => now()->subDays(15), 'updated_at' => now()->subDays(15)],
            
            // User 3 (Jane) - In progress Vue.js
            ['user_id' => 3, 'lesson_id' => 9, 'is_completed' => true, 'completed_at' => now()->subDays(18), 'last_position' => 1080, 'created_at' => now()->subDays(18), 'updated_at' => now()->subDays(18)],
            ['user_id' => 3, 'lesson_id' => 10, 'is_completed' => false, 'completed_at' => null, 'last_position' => 450, 'created_at' => now()->subDays(17), 'updated_at' => now()->subDays(2)],
            
            // User 3 (Jane) - Started RESTful API
            ['user_id' => 3, 'lesson_id' => 15, 'is_completed' => false, 'completed_at' => null, 'last_position' => 300, 'created_at' => now()->subDays(9), 'updated_at' => now()->subDays(1)],
            
            // User 4 (Bob) - In progress Laravel
            ['user_id' => 4, 'lesson_id' => 1, 'is_completed' => true, 'completed_at' => now()->subDays(27), 'last_position' => 900, 'created_at' => now()->subDays(27), 'updated_at' => now()->subDays(27)],
            ['user_id' => 4, 'lesson_id' => 2, 'is_completed' => true, 'completed_at' => now()->subDays(26), 'last_position' => 720, 'created_at' => now()->subDays(26), 'updated_at' => now()->subDays(26)],
            ['user_id' => 4, 'lesson_id' => 3, 'is_completed' => true, 'completed_at' => now()->subDays(25), 'last_position' => 0, 'created_at' => now()->subDays(25), 'updated_at' => now()->subDays(25)],
            ['user_id' => 4, 'lesson_id' => 4, 'is_completed' => true, 'completed_at' => now()->subDays(24), 'last_position' => 840, 'created_at' => now()->subDays(24), 'updated_at' => now()->subDays(24)],
            ['user_id' => 4, 'lesson_id' => 5, 'is_completed' => false, 'completed_at' => null, 'last_position' => 200, 'created_at' => now()->subDays(23), 'updated_at' => now()->subDays(5)],
            
            // User 4 (Bob) - Started Advanced PHP
            ['user_id' => 4, 'lesson_id' => 12, 'is_completed' => false, 'completed_at' => null, 'last_position' => 0, 'created_at' => now()->subDays(14), 'updated_at' => now()->subDays(3)],
            
            // User 5 (Alice) - Completed Vue.js
            ['user_id' => 5, 'lesson_id' => 9, 'is_completed' => true, 'completed_at' => now()->subDays(28), 'last_position' => 1080, 'created_at' => now()->subDays(28), 'updated_at' => now()->subDays(28)],
            ['user_id' => 5, 'lesson_id' => 10, 'is_completed' => true, 'completed_at' => now()->subDays(26), 'last_position' => 780, 'created_at' => now()->subDays(26), 'updated_at' => now()->subDays(26)],
            ['user_id' => 5, 'lesson_id' => 11, 'is_completed' => true, 'completed_at' => now()->subDays(24), 'last_position' => 1200, 'created_at' => now()->subDays(24), 'updated_at' => now()->subDays(24)],
            
            // User 5 (Alice) - Almost done Laravel
            ['user_id' => 5, 'lesson_id' => 1, 'is_completed' => true, 'completed_at' => now()->subDays(21), 'last_position' => 900, 'created_at' => now()->subDays(21), 'updated_at' => now()->subDays(21)],
            ['user_id' => 5, 'lesson_id' => 2, 'is_completed' => true, 'completed_at' => now()->subDays(20), 'last_position' => 720, 'created_at' => now()->subDays(20), 'updated_at' => now()->subDays(20)],
            ['user_id' => 5, 'lesson_id' => 3, 'is_completed' => true, 'completed_at' => now()->subDays(19), 'last_position' => 0, 'created_at' => now()->subDays(19), 'updated_at' => now()->subDays(19)],
            ['user_id' => 5, 'lesson_id' => 4, 'is_completed' => true, 'completed_at' => now()->subDays(18), 'last_position' => 840, 'created_at' => now()->subDays(18), 'updated_at' => now()->subDays(18)],
            ['user_id' => 5, 'lesson_id' => 5, 'is_completed' => true, 'completed_at' => now()->subDays(17), 'last_position' => 660, 'created_at' => now()->subDays(17), 'updated_at' => now()->subDays(17)],
            ['user_id' => 5, 'lesson_id' => 6, 'is_completed' => true, 'completed_at' => now()->subDays(16), 'last_position' => 1020, 'created_at' => now()->subDays(16), 'updated_at' => now()->subDays(16)],
            ['user_id' => 5, 'lesson_id' => 7, 'is_completed' => false, 'completed_at' => null, 'last_position' => 0, 'created_at' => now()->subDays(15), 'updated_at' => now()->subDays(4)],
            
            // User 5 (Alice) - In progress RESTful API
            ['user_id' => 5, 'lesson_id' => 15, 'is_completed' => true, 'completed_at' => now()->subDays(10), 'last_position' => 1020, 'created_at' => now()->subDays(10), 'updated_at' => now()->subDays(10)],
            ['user_id' => 5, 'lesson_id' => 16, 'is_completed' => false, 'completed_at' => null, 'last_position' => 0, 'created_at' => now()->subDays(9), 'updated_at' => now()->subDays(2)],
            
            // User 1 (Admin) - In progress Vue.js
            ['user_id' => 1, 'lesson_id' => 9, 'is_completed' => true, 'completed_at' => now()->subDays(17), 'last_position' => 1080, 'created_at' => now()->subDays(17), 'updated_at' => now()->subDays(17)],
            ['user_id' => 1, 'lesson_id' => 10, 'is_completed' => false, 'completed_at' => null, 'last_position' => 520, 'created_at' => now()->subDays(16), 'updated_at' => now()->subDays(6)],
            
            // User 2 (Contributor) - In progress Advanced PHP
            ['user_id' => 2, 'lesson_id' => 12, 'is_completed' => true, 'completed_at' => now()->subDays(14), 'last_position' => 0, 'created_at' => now()->subDays(14), 'updated_at' => now()->subDays(14)],
            ['user_id' => 2, 'lesson_id' => 13, 'is_completed' => false, 'completed_at' => null, 'last_position' => 1140, 'created_at' => now()->subDays(13), 'updated_at' => now()->subDays(7)],
            ['user_id' => 2, 'lesson_id' => 14, 'is_completed' => false, 'completed_at' => null, 'last_position' => 450, 'created_at' => now()->subDays(12), 'updated_at' => now()->subDays(4)],
        ];

        DB::table('user_progress')->insert($progress);
    }
}