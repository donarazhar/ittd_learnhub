<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscussionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $discussions = [
            // Lesson 1 discussions
            [
                'lesson_id' => 1,
                'user_id' => 3,
                'title' => 'Perbedaan Laravel dengan framework PHP lainnya?',
                'content' => 'Saya masih bingung apa yang membuat Laravel lebih baik dibanding framework seperti CodeIgniter atau Symfony. Bisa dijelaskan?',
                'is_pinned' => true,
                'replies_count' => 3,
                'created_at' => now()->subDays(23),
                'updated_at' => now()->subDays(23),
            ],
            [
                'lesson_id' => 1,
                'user_id' => 4,
                'title' => 'Laravel vs Node.js untuk backend?',
                'content' => 'Untuk project baru, lebih baik pakai Laravel atau Node.js ya? Mohon sarannya.',
                'is_pinned' => false,
                'replies_count' => 2,
                'created_at' => now()->subDays(22),
                'updated_at' => now()->subDays(22),
            ],
            
            // Lesson 2 discussions
            [
                'lesson_id' => 2,
                'user_id' => 5,
                'title' => 'Error saat instalasi Laravel',
                'content' => 'Saya mendapat error "composer: command not found" saat mencoba install Laravel. Bagaimana solusinya?',
                'is_pinned' => false,
                'replies_count' => 4,
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(21),
            ],
            
            // Lesson 4 discussions
            [
                'lesson_id' => 4,
                'user_id' => 3,
                'title' => 'Best practice untuk route naming',
                'content' => 'Apakah ada konvensi khusus untuk penamaan routes di Laravel? Saya ingin kode saya lebih organized.',
                'is_pinned' => false,
                'replies_count' => 2,
                'created_at' => now()->subDays(19),
                'updated_at' => now()->subDays(19),
            ],
            
            // Lesson 6 discussions
            [
                'lesson_id' => 6,
                'user_id' => 4,
                'title' => 'Resource Controller vs Regular Controller',
                'content' => 'Kapan sebaiknya menggunakan resource controller dan kapan menggunakan regular controller?',
                'is_pinned' => true,
                'replies_count' => 3,
                'created_at' => now()->subDays(17),
                'updated_at' => now()->subDays(17),
            ],
            
            // Lesson 8 discussions
            [
                'lesson_id' => 8,
                'user_id' => 5,
                'title' => 'Migration rollback tidak bekerja',
                'content' => 'Saya coba php artisan migrate:rollback tapi tidak ada yang terjadi. Ada yang salah?',
                'is_pinned' => false,
                'replies_count' => 5,
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
            [
                'lesson_id' => 8,
                'user_id' => 3,
                'title' => 'Tips untuk migration yang kompleks',
                'content' => 'Untuk project besar dengan banyak tabel dan relasi, ada tips khusus untuk manage migrations?',
                'is_pinned' => false,
                'replies_count' => 1,
                'created_at' => now()->subDays(14),
                'updated_at' => now()->subDays(14),
            ],
            
            // Lesson 9 discussions
            [
                'lesson_id' => 9,
                'user_id' => 1,
                'title' => 'Vue 2 vs Vue 3',
                'content' => 'Apakah course ini menggunakan Vue 2 atau Vue 3? Apa perbedaan utamanya?',
                'is_pinned' => true,
                'replies_count' => 2,
                'created_at' => now()->subDays(16),
                'updated_at' => now()->subDays(16),
            ],
            
            // Lesson 11 discussions
            [
                'lesson_id' => 11,
                'user_id' => 5,
                'title' => 'Component communication best practices',
                'content' => 'Bagaimana cara terbaik untuk komunikasi antar component? Props, events, atau Vuex?',
                'is_pinned' => false,
                'replies_count' => 4,
                'created_at' => now()->subDays(13),
                'updated_at' => now()->subDays(13),
            ],
            
            // Lesson 12 discussions
            [
                'lesson_id' => 12,
                'user_id' => 2,
                'title' => 'Real-world use case untuk Singleton pattern',
                'content' => 'Bisa kasih contoh konkret kapan kita harus pakai Singleton pattern dalam project Laravel?',
                'is_pinned' => false,
                'replies_count' => 3,
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
            
            // Lesson 15 discussions
            [
                'lesson_id' => 15,
                'user_id' => 3,
                'title' => 'API Versioning strategy',
                'content' => 'Untuk API versioning, lebih baik pakai URL versioning atau header versioning?',
                'is_pinned' => false,
                'replies_count' => 2,
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(8),
            ],
            [
                'lesson_id' => 15,
                'user_id' => 5,
                'title' => 'Rate limiting di REST API',
                'content' => 'Bagaimana cara implement rate limiting yang efektif untuk API?',
                'is_pinned' => true,
                'replies_count' => 1,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
        ];

        DB::table('discussions')->insert($discussions);
    }
}