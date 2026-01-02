<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CoursesTableSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'created_by' => 2, // Kontributor
                'title' => 'Laravel Fundamental',
                'slug' => 'laravel-fundamental',
                'description' => 'Pelajari dasar-dasar Laravel framework dari instalasi hingga membuat aplikasi web pertama Anda.',
                'thumbnail' => 'courses/laravel-fundamental.jpg',
                'level' => 'beginner',
                'estimated_duration' => 480, // 8 jam
                'status' => 'published',
                'total_enrolled' => 15,
                'average_rating' => 4.50,
                'published_at' => now()->subDays(30),
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(30),
            ],
            [
                'created_by' => 2,
                'title' => 'Vue.js for Beginners',
                'slug' => 'vuejs-for-beginners',
                'description' => 'Mulai perjalanan Anda dalam pengembangan frontend modern dengan Vue.js. Cocok untuk pemula!',
                'thumbnail' => 'courses/vuejs.jpg',
                'level' => 'beginner',
                'estimated_duration' => 360, // 6 jam
                'status' => 'published',
                'total_enrolled' => 23,
                'average_rating' => 4.75,
                'published_at' => now()->subDays(45),
                'created_at' => now()->subDays(45),
                'updated_at' => now()->subDays(45),
            ],
            [
                'created_by' => 1, // Admin
                'title' => 'Advanced PHP Programming',
                'slug' => 'advanced-php-programming',
                'description' => 'Tingkatkan kemampuan PHP Anda dengan teknik-teknik advanced seperti design patterns, testing, dan best practices.',
                'thumbnail' => 'courses/advanced-php.jpg',
                'level' => 'advanced',
                'estimated_duration' => 720, // 12 jam
                'status' => 'published',
                'total_enrolled' => 8,
                'average_rating' => 4.90,
                'published_at' => now()->subDays(20),
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
            [
                'created_by' => 2,
                'title' => 'RESTful API Development',
                'slug' => 'restful-api-development',
                'description' => 'Belajar membangun RESTful API yang scalable dan secure menggunakan Laravel.',
                'thumbnail' => 'courses/restful-api.jpg',
                'level' => 'intermediate',
                'estimated_duration' => 540, // 9 jam
                'status' => 'published',
                'total_enrolled' => 12,
                'average_rating' => 4.65,
                'published_at' => now()->subDays(15),
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
            [
                'created_by' => 1,
                'title' => 'Database Design Mastery',
                'slug' => 'database-design-mastery',
                'description' => 'Kuasai seni desain database dari normalisasi hingga optimasi query.',
                'thumbnail' => null,
                'level' => 'intermediate',
                'estimated_duration' => 600, // 10 jam
                'status' => 'draft',
                'total_enrolled' => 0,
                'average_rating' => 0.00,
                'published_at' => null,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
        ];

        DB::table('courses')->insert($courses);
    }
}