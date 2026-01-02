<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonReferencesTableSeeder extends Seeder
{
    public function run(): void
    {
        $references = [
            // Lesson 1
            [
                'lesson_id' => 1,
                'title' => 'Laravel Official Documentation',
                'url' => 'https://laravel.com/docs',
                'type' => 'website',
                'order' => 1,
                'created_at' => now(),
            ],
            [
                'lesson_id' => 1,
                'title' => 'Laravel: Up & Running',
                'url' => 'https://www.oreilly.com/library/view/laravel-up/9781492041207/',
                'type' => 'book',
                'order' => 2,
                'created_at' => now(),
            ],
            
            // Lesson 2
            [
                'lesson_id' => 2,
                'title' => 'Composer Installation Guide',
                'url' => 'https://getcomposer.org/doc/00-intro.md',
                'type' => 'article',
                'order' => 1,
                'created_at' => now(),
            ],
            
            // Lesson 4
            [
                'lesson_id' => 4,
                'title' => 'Laravel Routing Documentation',
                'url' => 'https://laravel.com/docs/routing',
                'type' => 'website',
                'order' => 1,
                'created_at' => now(),
            ],
            
            // Lesson 6
            [
                'lesson_id' => 6,
                'title' => 'Laravel Controllers',
                'url' => 'https://laravel.com/docs/controllers',
                'type' => 'website',
                'order' => 1,
                'created_at' => now(),
            ],
            
            // Lesson 8
            [
                'lesson_id' => 8,
                'title' => 'Database Migrations',
                'url' => 'https://laravel.com/docs/migrations',
                'type' => 'website',
                'order' => 1,
                'created_at' => now(),
            ],
            [
                'lesson_id' => 8,
                'title' => 'Understanding Database Migrations',
                'url' => 'https://www.youtube.com/watch?v=example',
                'type' => 'video',
                'order' => 2,
                'created_at' => now(),
            ],
            
            // Lesson 9
            [
                'lesson_id' => 9,
                'title' => 'Vue.js Guide',
                'url' => 'https://vuejs.org/guide/introduction.html',
                'type' => 'website',
                'order' => 1,
                'created_at' => now(),
            ],
            [
                'lesson_id' => 9,
                'title' => 'Vue Mastery - Intro to Vue.js',
                'url' => 'https://www.vuemastery.com/courses/intro-to-vue-js/',
                'type' => 'video',
                'order' => 2,
                'created_at' => now(),
            ],
            
            // Lesson 11
            [
                'lesson_id' => 11,
                'title' => 'Vue Components Documentation',
                'url' => 'https://vuejs.org/guide/essentials/component-basics.html',
                'type' => 'website',
                'order' => 1,
                'created_at' => now(),
            ],
            
            // Lesson 12
            [
                'lesson_id' => 12,
                'title' => 'Design Patterns: Elements of Reusable Object-Oriented Software',
                'url' => 'https://www.amazon.com/Design-Patterns-Elements-Reusable-Object-Oriented/dp/0201633612',
                'type' => 'book',
                'order' => 1,
                'created_at' => now(),
            ],
            [
                'lesson_id' => 12,
                'title' => 'Refactoring Guru - Design Patterns',
                'url' => 'https://refactoring.guru/design-patterns',
                'type' => 'website',
                'order' => 2,
                'created_at' => now(),
            ],
            
            // Lesson 14
            [
                'lesson_id' => 14,
                'title' => 'PHPUnit Documentation',
                'url' => 'https://phpunit.de/documentation.html',
                'type' => 'website',
                'order' => 1,
                'created_at' => now(),
            ],
            [
                'lesson_id' => 14,
                'title' => 'Test Driven Development: By Example',
                'url' => 'https://www.amazon.com/Test-Driven-Development-Kent-Beck/dp/0321146530',
                'type' => 'book',
                'order' => 2,
                'created_at' => now(),
            ],
            
            // Lesson 15
            [
                'lesson_id' => 15,
                'title' => 'RESTful API Design Best Practices',
                'url' => 'https://www.freecodecamp.org/news/rest-api-best-practices/',
                'type' => 'article',
                'order' => 1,
                'created_at' => now(),
            ],
            [
                'lesson_id' => 15,
                'title' => 'REST API Tutorial',
                'url' => 'https://restfulapi.net/',
                'type' => 'website',
                'order' => 2,
                'created_at' => now(),
            ],
            
            // Lesson 17
            [
                'lesson_id' => 17,
                'title' => 'JWT.io Introduction',
                'url' => 'https://jwt.io/introduction',
                'type' => 'website',
                'order' => 1,
                'created_at' => now(),
            ],
            [
                'lesson_id' => 17,
                'title' => 'Laravel JWT Auth Package',
                'url' => 'https://github.com/tymondesigns/jwt-auth',
                'type' => 'website',
                'order' => 2,
                'created_at' => now(),
            ],
        ];

        DB::table('lesson_references')->insert($references);
    }
}