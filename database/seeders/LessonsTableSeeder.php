<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LessonsTableSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = [
            // Module 1: Pengenalan Laravel
            [
                'module_id' => 1,
                'title' => 'Apa itu Laravel?',
                'slug' => 'apa-itu-laravel',
                'content' => '<h2>Pengenalan Laravel</h2><p>Laravel adalah PHP framework yang elegant dan powerful untuk web development.</p>',
                'video_url' => 'https://www.youtube.com/embed/ImtZ5yENzgE',
                'video_duration' => 900, // 15 menit
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_id' => 1,
                'title' => 'Instalasi Laravel',
                'slug' => 'instalasi-laravel',
                'content' => '<h2>Instalasi Laravel</h2><p>Panduan lengkap instalasi Laravel menggunakan Composer.</p>',
                'video_url' => 'https://www.youtube.com/embed/BXiHvgrJfkg',
                'video_duration' => 720, // 12 menit
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_id' => 1,
                'title' => 'Struktur Direktori Laravel',
                'slug' => 'struktur-direktori-laravel',
                'content' => '<h2>Struktur Direktori</h2><p>Memahami struktur folder dan file di Laravel.</p>',
                'video_url' => null,
                'video_duration' => null,
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Module 2: Routing dan Controllers
            [
                'module_id' => 2,
                'title' => 'Basic Routing',
                'slug' => 'basic-routing',
                'content' => '<h2>Routing di Laravel</h2><p>Belajar membuat routes sederhana.</p>',
                'video_url' => 'https://www.youtube.com/embed/5K6Kp6M5iGk',
                'video_duration' => 840, // 14 menit
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_id' => 2,
                'title' => 'Route Parameters',
                'slug' => 'route-parameters',
                'content' => '<h2>Route Parameters</h2><p>Menggunakan parameter dinamis di routes.</p>',
                'video_url' => 'https://www.youtube.com/embed/Y9bR9nW3GMo',
                'video_duration' => 660, // 11 menit
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_id' => 2,
                'title' => 'Controllers',
                'slug' => 'controllers',
                'content' => '<h2>Controllers</h2><p>Membuat dan menggunakan controllers.</p>',
                'video_url' => 'https://www.youtube.com/embed/z7ELZcRnfNM',
                'video_duration' => 1020, // 17 menit
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Module 3: Database dan Eloquent ORM
            [
                'module_id' => 3,
                'title' => 'Database Configuration',
                'slug' => 'database-configuration',
                'content' => '<h2>Konfigurasi Database</h2><p>Setup koneksi database di Laravel.</p>',
                'video_url' => null,
                'video_duration' => null,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_id' => 3,
                'title' => 'Migrations',
                'slug' => 'migrations',
                'content' => '<h2>Migrations</h2><p>Membuat dan menjalankan database migrations.</p>',
                'video_url' => 'https://www.youtube.com/embed/BwWlUwtZiuU',
                'video_duration' => 960, // 16 menit
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Module 4: Vue.js Basics
            [
                'module_id' => 4,
                'title' => 'Introduction to Vue.js',
                'slug' => 'introduction-to-vuejs',
                'content' => '<h2>Vue.js Introduction</h2><p>Mengenal Vue.js framework.</p>',
                'video_url' => 'https://www.youtube.com/embed/YrxBCBibVo0',
                'video_duration' => 1080, // 18 menit
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_id' => 4,
                'title' => 'Vue Instance',
                'slug' => 'vue-instance',
                'content' => '<h2>Vue Instance</h2><p>Membuat Vue instance pertama.</p>',
                'video_url' => 'https://www.youtube.com/embed/VuN7UrRCqcQ',
                'video_duration' => 780, // 13 menit
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Module 5: Components dan Props
            [
                'module_id' => 5,
                'title' => 'Creating Components',
                'slug' => 'creating-components',
                'content' => '<h2>Vue Components</h2><p>Cara membuat component di Vue.js.</p>',
                'video_url' => 'https://www.youtube.com/embed/VZBDpWI-yfg',
                'video_duration' => 1200, // 20 menit
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Module 6: Design Patterns in PHP
            [
                'module_id' => 6,
                'title' => 'Singleton Pattern',
                'slug' => 'singleton-pattern',
                'content' => '<h2>Singleton Pattern</h2><p>Implementasi Singleton pattern di PHP.</p>',
                'video_url' => null,
                'video_duration' => null,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_id' => 6,
                'title' => 'Factory Pattern',
                'slug' => 'factory-pattern',
                'content' => '<h2>Factory Pattern</h2><p>Menggunakan Factory pattern.</p>',
                'video_url' => 'https://www.youtube.com/embed/s_4ZrtQs8Do',
                'video_duration' => 1140, // 19 menit
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Module 7: Testing dan TDD
            [
                'module_id' => 7,
                'title' => 'PHPUnit Setup',
                'slug' => 'phpunit-setup',
                'content' => '<h2>PHPUnit Setup</h2><p>Instalasi dan konfigurasi PHPUnit.</p>',
                'video_url' => 'https://www.youtube.com/embed/ZYMhR8cXCco',
                'video_duration' => 900, // 15 menit
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Module 8: REST API Fundamentals
            [
                'module_id' => 8,
                'title' => 'What is REST?',
                'slug' => 'what-is-rest',
                'content' => '<h2>REST API Basics</h2><p>Memahami konsep REST API.</p>',
                'video_url' => 'https://www.youtube.com/embed/-MTSQjw5DrM',
                'video_duration' => 1020, // 17 menit
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_id' => 8,
                'title' => 'HTTP Methods',
                'slug' => 'http-methods',
                'content' => '<h2>HTTP Methods</h2><p>GET, POST, PUT, DELETE explained.</p>',
                'video_url' => null,
                'video_duration' => null,
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Module 9: Authentication dan Authorization
            [
                'module_id' => 9,
                'title' => 'JWT Authentication',
                'slug' => 'jwt-authentication',
                'content' => '<h2>JWT Auth</h2><p>Implementasi JWT di Laravel API.</p>',
                'video_url' => 'https://www.youtube.com/embed/l221z0lbLWw',
                'video_duration' => 1440, // 24 menit
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Module 10: Database Normalization
            [
                'module_id' => 10,
                'title' => '1NF, 2NF, 3NF',
                'slug' => '1nf-2nf-3nf',
                'content' => '<h2>Normal Forms</h2><p>Memahami bentuk normal database.</p>',
                'video_url' => null,
                'video_duration' => null,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('lessons')->insert($lessons);
    }
}