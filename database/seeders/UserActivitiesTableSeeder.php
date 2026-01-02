<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserActivitiesTableSeeder extends Seeder
{
    public function run(): void
    {
        $activities = [
            // User 3 activities
            [
                'user_id' => 3,
                'activity_type' => 'course_enrolled',
                'activity_data' => json_encode([
                    'course_id' => 1,
                    'course_title' => 'Laravel Fundamental',
                ]),
                'created_at' => now()->subDays(25),
            ],
            [
                'user_id' => 3,
                'activity_type' => 'lesson_completed',
                'activity_data' => json_encode([
                    'lesson_id' => 1,
                    'lesson_title' => 'Apa itu Laravel?',
                    'course_id' => 1,
                ]),
                'created_at' => now()->subDays(24),
            ],
            [
                'user_id' => 3,
                'activity_type' => 'lesson_completed',
                'activity_data' => json_encode([
                    'lesson_id' => 2,
                    'lesson_title' => 'Instalasi Laravel',
                    'course_id' => 1,
                ]),
                'created_at' => now()->subDays(23),
            ],
            [
                'user_id' => 3,
                'activity_type' => 'course_enrolled',
                'activity_data' => json_encode([
                    'course_id' => 2,
                    'course_title' => 'Vue.js for Beginners',
                ]),
                'created_at' => now()->subDays(20),
            ],
            [
                'user_id' => 3,
                'activity_type' => 'course_completed',
                'activity_data' => json_encode([
                    'course_id' => 1,
                    'course_title' => 'Laravel Fundamental',
                    'completion_percentage' => 100,
                ]),
                'created_at' => now()->subDays(5),
            ],
            [
                'user_id' => 3,
                'activity_type' => 'course_reviewed',
                'activity_data' => json_encode([
                    'course_id' => 1,
                    'course_title' => 'Laravel Fundamental',
                    'rating' => 5,
                ]),
                'created_at' => now()->subDays(5),
            ],
            [
                'user_id' => 3,
                'activity_type' => 'course_enrolled',
                'activity_data' => json_encode([
                    'course_id' => 4,
                    'course_title' => 'RESTful API Development',
                ]),
                'created_at' => now()->subDays(10),
            ],
            
            // User 4 activities
            [
                'user_id' => 4,
                'activity_type' => 'course_enrolled',
                'activity_data' => json_encode([
                    'course_id' => 1,
                    'course_title' => 'Laravel Fundamental',
                ]),
                'created_at' => now()->subDays(28),
            ],
            [
                'user_id' => 4,
                'activity_type' => 'lesson_completed',
                'activity_data' => json_encode([
                    'lesson_id' => 1,
                    'lesson_title' => 'Apa itu Laravel?',
                    'course_id' => 1,
                ]),
                'created_at' => now()->subDays(27),
            ],
            [
                'user_id' => 4,
                'activity_type' => 'lesson_completed',
                'activity_data' => json_encode([
                    'lesson_id' => 4,
                    'lesson_title' => 'Basic Routing',
                    'course_id' => 1,
                ]),
                'created_at' => now()->subDays(24),
            ],
            [
                'user_id' => 4,
                'activity_type' => 'course_enrolled',
                'activity_data' => json_encode([
                    'course_id' => 3,
                    'course_title' => 'Advanced PHP Programming',
                ]),
                'created_at' => now()->subDays(15),
            ],
            [
                'user_id' => 4,
                'activity_type' => 'course_reviewed',
                'activity_data' => json_encode([
                    'course_id' => 1,
                    'course_title' => 'Laravel Fundamental',
                    'rating' => 4,
                ]),
                'created_at' => now()->subDays(10),
            ],
            
            // User 5 activities
            [
                'user_id' => 5,
                'activity_type' => 'course_enrolled',
                'activity_data' => json_encode([
                    'course_id' => 2,
                    'course_title' => 'Vue.js for Beginners',
                ]),
                'created_at' => now()->subDays(30),
            ],
            [
                'user_id' => 5,
                'activity_type' => 'lesson_completed',
                'activity_data' => json_encode([
                    'lesson_id' => 9,
                    'lesson_title' => 'Introduction to Vue.js',
                    'course_id' => 2,
                ]),
                'created_at' => now()->subDays(28),
            ],
            [
                'user_id' => 5,
                'activity_type' => 'lesson_completed',
                'activity_data' => json_encode([
                    'lesson_id' => 11,
                    'lesson_title' => 'Creating Components',
                    'course_id' => 2,
                ]),
                'created_at' => now()->subDays(24),
            ],
            [
                'user_id' => 5,
                'activity_type' => 'course_enrolled',
                'activity_data' => json_encode([
                    'course_id' => 1,
                    'course_title' => 'Laravel Fundamental',
                ]),
                'created_at' => now()->subDays(22),
            ],
            [
                'user_id' => 5,
                'activity_type' => 'course_completed',
                'activity_data' => json_encode([
                    'course_id' => 2,
                    'course_title' => 'Vue.js for Beginners',
                    'completion_percentage' => 100,
                ]),
                'created_at' => now()->subDays(8),
            ],
            [
                'user_id' => 5,
                'activity_type' => 'course_reviewed',
                'activity_data' => json_encode([
                    'course_id' => 2,
                    'course_title' => 'Vue.js for Beginners',
                    'rating' => 5,
                ]),
                'created_at' => now()->subDays(8),
            ],
            [
                'user_id' => 5,
                'activity_type' => 'course_enrolled',
                'activity_data' => json_encode([
                    'course_id' => 4,
                    'course_title' => 'RESTful API Development',
                ]),
                'created_at' => now()->subDays(12),
            ],
            [
                'user_id' => 5,
                'activity_type' => 'lesson_completed',
                'activity_data' => json_encode([
                    'lesson_id' => 15,
                    'lesson_title' => 'What is REST?',
                    'course_id' => 4,
                ]),
                'created_at' => now()->subDays(10),
            ],
            
            // User 1 (Admin) activities
            [
                'user_id' => 1,
                'activity_type' => 'course_enrolled',
                'activity_data' => json_encode([
                    'course_id' => 2,
                    'course_title' => 'Vue.js for Beginners',
                ]),
                'created_at' => now()->subDays(18),
            ],
            [
                'user_id' => 1,
                'activity_type' => 'lesson_completed',
                'activity_data' => json_encode([
                    'lesson_id' => 9,
                    'lesson_title' => 'Introduction to Vue.js',
                    'course_id' => 2,
                ]),
                'created_at' => now()->subDays(17),
            ],
            [
                'user_id' => 1,
                'activity_type' => 'course_reviewed',
                'activity_data' => json_encode([
                    'course_id' => 2,
                    'course_title' => 'Vue.js for Beginners',
                    'rating' => 4,
                ]),
                'created_at' => now()->subDays(12),
            ],
            
            // User 2 (Contributor) activities
            [
                'user_id' => 2,
                'activity_type' => 'course_created',
                'activity_data' => json_encode([
                    'course_id' => 1,
                    'course_title' => 'Laravel Fundamental',
                ]),
                'created_at' => now()->subDays(30),
            ],
            [
                'user_id' => 2,
                'activity_type' => 'course_published',
                'activity_data' => json_encode([
                    'course_id' => 1,
                    'course_title' => 'Laravel Fundamental',
                ]),
                'created_at' => now()->subDays(30),
            ],
            [
                'user_id' => 2,
                'activity_type' => 'course_enrolled',
                'activity_data' => json_encode([
                    'course_id' => 3,
                    'course_title' => 'Advanced PHP Programming',
                ]),
                'created_at' => now()->subDays(16),
            ],
            [
                'user_id' => 2,
                'activity_type' => 'lesson_completed',
                'activity_data' => json_encode([
                    'lesson_id' => 12,
                    'lesson_title' => 'Singleton Pattern',
                    'course_id' => 3,
                ]),
                'created_at' => now()->subDays(14),
            ],
            [
                'user_id' => 2,
                'activity_type' => 'course_reviewed',
                'activity_data' => json_encode([
                    'course_id' => 3,
                    'course_title' => 'Advanced PHP Programming',
                    'rating' => 5,
                ]),
                'created_at' => now()->subDays(4),
            ],
        ];

        DB::table('user_activities')->insert($activities);
    }
}