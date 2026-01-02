<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $enrollments = [
            // User 3 (Jane) enrollments
            [
                'user_id' => 3,
                'course_id' => 1, // Laravel Fundamental
                'enrolled_at' => now()->subDays(25),
                'completed_at' => now()->subDays(5),
                'progress_percentage' => 100.00,
                'last_accessed_lesson_id' => 8,
            ],
            [
                'user_id' => 3,
                'course_id' => 2, // Vue.js for Beginners
                'enrolled_at' => now()->subDays(20),
                'completed_at' => null,
                'progress_percentage' => 65.00,
                'last_accessed_lesson_id' => 10,
            ],
            [
                'user_id' => 3,
                'course_id' => 4, // RESTful API Development
                'enrolled_at' => now()->subDays(10),
                'completed_at' => null,
                'progress_percentage' => 30.00,
                'last_accessed_lesson_id' => 15,
            ],
            
            // User 4 (Bob) enrollments
            [
                'user_id' => 4,
                'course_id' => 1, // Laravel Fundamental
                'enrolled_at' => now()->subDays(28),
                'completed_at' => null,
                'progress_percentage' => 45.00,
                'last_accessed_lesson_id' => 5,
            ],
            [
                'user_id' => 4,
                'course_id' => 3, // Advanced PHP Programming
                'enrolled_at' => now()->subDays(15),
                'completed_at' => null,
                'progress_percentage' => 20.00,
                'last_accessed_lesson_id' => 12,
            ],
            
            // User 5 (Alice) enrollments
            [
                'user_id' => 5,
                'course_id' => 2, // Vue.js for Beginners
                'enrolled_at' => now()->subDays(30),
                'completed_at' => now()->subDays(8),
                'progress_percentage' => 100.00,
                'last_accessed_lesson_id' => 11,
            ],
            [
                'user_id' => 5,
                'course_id' => 1, // Laravel Fundamental
                'enrolled_at' => now()->subDays(22),
                'completed_at' => null,
                'progress_percentage' => 80.00,
                'last_accessed_lesson_id' => 7,
            ],
            [
                'user_id' => 5,
                'course_id' => 4, // RESTful API Development
                'enrolled_at' => now()->subDays(12),
                'completed_at' => null,
                'progress_percentage' => 50.00,
                'last_accessed_lesson_id' => 16,
            ],
            
            // Admin (user 1) enrolled in one course
            [
                'user_id' => 1,
                'course_id' => 2, // Vue.js for Beginners
                'enrolled_at' => now()->subDays(18),
                'completed_at' => null,
                'progress_percentage' => 40.00,
                'last_accessed_lesson_id' => 9,
            ],
            
            // Contributor (user 2) enrolled in courses
            [
                'user_id' => 2,
                'course_id' => 3, // Advanced PHP Programming
                'enrolled_at' => now()->subDays(16),
                'completed_at' => null,
                'progress_percentage' => 55.00,
                'last_accessed_lesson_id' => 13,
            ],
        ];

        DB::table('enrollments')->insert($enrollments);
    }
}