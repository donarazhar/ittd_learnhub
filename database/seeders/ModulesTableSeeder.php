<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            // Course 1: Laravel Fundamental
            [
                'course_id' => 1,
                'title' => 'Pengenalan Laravel',
                'description' => 'Memahami konsep dasar Laravel dan ekosistemnya',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'title' => 'Routing dan Controllers',
                'description' => 'Belajar membuat routes dan controllers di Laravel',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'title' => 'Database dan Eloquent ORM',
                'description' => 'Menguasai database operations dengan Eloquent',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Course 2: Vue.js for Beginners
            [
                'course_id' => 2,
                'title' => 'Vue.js Basics',
                'description' => 'Fundamental Vue.js dan reactive programming',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'title' => 'Components dan Props',
                'description' => 'Membuat dan menggunakan Vue components',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Course 3: Advanced PHP Programming
            [
                'course_id' => 3,
                'title' => 'Design Patterns in PHP',
                'description' => 'Implementasi design patterns untuk code yang maintainable',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 3,
                'title' => 'Testing dan TDD',
                'description' => 'Test-Driven Development dengan PHPUnit',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Course 4: RESTful API Development
            [
                'course_id' => 4,
                'title' => 'REST API Fundamentals',
                'description' => 'Konsep dasar RESTful API design',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 4,
                'title' => 'Authentication dan Authorization',
                'description' => 'Implementasi security di API',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Course 5: Database Design Mastery (draft)
            [
                'course_id' => 5,
                'title' => 'Database Normalization',
                'description' => 'Teknik normalisasi database',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('modules')->insert($modules);
    }
}