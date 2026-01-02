<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserNotesTableSeeder extends Seeder
{
    public function run(): void
    {
        $notes = [
            // User 3 (Jane) notes
            [
                'user_id' => 3,
                'lesson_id' => 1,
                'note' => 'Laravel adalah PHP framework yang menggunakan pola MVC. Sangat membantu untuk membuat aplikasi web dengan cepat.',
                'created_at' => now()->subDays(24),
                'updated_at' => now()->subDays(24),
            ],
            [
                'user_id' => 3,
                'lesson_id' => 2,
                'note' => 'Langkah instalasi: 1) Install Composer, 2) composer create-project laravel/laravel nama-project, 3) php artisan serve',
                'created_at' => now()->subDays(23),
                'updated_at' => now()->subDays(23),
            ],
            [
                'user_id' => 3,
                'lesson_id' => 4,
                'note' => 'Route::get(\'/users\', [UserController::class, \'index\']); - Contoh basic routing',
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
            [
                'user_id' => 3,
                'lesson_id' => 5,
                'note' => 'Parameter dinamis: Route::get(\'/user/{id}\', function($id) {...}). Bisa juga pakai where untuk validasi.',
                'created_at' => now()->subDays(19),
                'updated_at' => now()->subDays(19),
            ],
            [
                'user_id' => 3,
                'lesson_id' => 9,
                'note' => 'Vue.js menggunakan reactive data binding. {{ message }} untuk interpolation.',
                'created_at' => now()->subDays(18),
                'updated_at' => now()->subDays(18),
            ],

            // User 4 (Bob) notes
            [
                'user_id' => 4,
                'lesson_id' => 1,
                'note' => 'Framework ini terlihat sangat powerful. Excited untuk belajar lebih dalam!',
                'created_at' => now()->subDays(27),
                'updated_at' => now()->subDays(27),
            ],
            [
                'user_id' => 4,
                'lesson_id' => 2,
                'note' => 'Jangan lupa update composer secara berkala: composer update',
                'created_at' => now()->subDays(26),
                'updated_at' => now()->subDays(26),
            ],
            [
                'user_id' => 4,
                'lesson_id' => 4,
                'note' => 'Route groups berguna untuk mengelompokkan route dengan prefix atau middleware yang sama.',
                'created_at' => now()->subDays(24),
                'updated_at' => now()->subDays(24),
            ],
            [
                'user_id' => 4,
                'lesson_id' => 12,
                'note' => 'Singleton: Memastikan class hanya punya satu instance. Private constructor + static getInstance() method.',
                'created_at' => now()->subDays(14),
                'updated_at' => now()->subDays(14),
            ],

            // User 5 (Alice) notes
            [
                'user_id' => 5,
                'lesson_id' => 9,
                'note' => 'Vue instance dibuat dengan: new Vue({ el: \'#app\', data: {...} })',
                'created_at' => now()->subDays(28),
                'updated_at' => now()->subDays(28),
            ],
            [
                'user_id' => 5,
                'lesson_id' => 10,
                'note' => 'Vue lifecycle hooks: created, mounted, updated, destroyed. Penting untuk memahami kapan menggunakan masing-masing.',
                'created_at' => now()->subDays(26),
                'updated_at' => now()->subDays(26),
            ],
            [
                'user_id' => 5,
                'lesson_id' => 11,
                'note' => 'Component props: props: [\'title\', \'content\']. Atau bisa pakai object syntax untuk validation.',
                'created_at' => now()->subDays(24),
                'updated_at' => now()->subDays(24),
            ],
            [
                'user_id' => 5,
                'lesson_id' => 1,
                'note' => 'Artisan commands sangat membantu: php artisan make:controller, make:model, make:migration',
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(21),
            ],
            [
                'user_id' => 5,
                'lesson_id' => 6,
                'note' => 'Resource controller: php artisan make:controller UserController --resource. Includes index, create, store, show, edit, update, destroy.',
                'created_at' => now()->subDays(16),
                'updated_at' => now()->subDays(16),
            ],
            [
                'user_id' => 5,
                'lesson_id' => 15,
                'note' => 'REST principles: Stateless, Cacheable, Uniform Interface, Layered System. HTTP methods: GET (read), POST (create), PUT/PATCH (update), DELETE (delete).',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],

            // User 1 (Admin) notes
            [
                'user_id' => 1,
                'lesson_id' => 9,
                'note' => 'Comparing Vue.js with React for our next project. Vue seems more straightforward for beginners.',
                'created_at' => now()->subDays(17),
                'updated_at' => now()->subDays(17),
            ],
            [
                'user_id' => 1,
                'lesson_id' => 10,
                'note' => 'v-model untuk two-way data binding. Sangat berguna untuk forms!',
                'created_at' => now()->subDays(16),
                'updated_at' => now()->subDays(16),
            ],

            // User 2 (Contributor) notes
            [
                'user_id' => 2,
                'lesson_id' => 12,
                'note' => 'Factory pattern sangat berguna saat kita perlu membuat object yang kompleks. Contoh: DatabaseFactory untuk create different DB connections.',
                'created_at' => now()->subDays(14),
                'updated_at' => now()->subDays(14),
            ],
            [
                'user_id' => 2,
                'lesson_id' => 14,
                'note' => 'TDD workflow: Red (write failing test) -> Green (make it pass) -> Refactor. Always write test first!',
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
        ];

        DB::table('user_notes')->insert($notes);
    }
}
