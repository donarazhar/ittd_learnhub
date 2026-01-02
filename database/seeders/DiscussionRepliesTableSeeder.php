<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscussionRepliesTableSeeder extends Seeder
{
    public function run(): void
    {
        $replies = [
            // Replies to Discussion 1 (Perbedaan Laravel dengan framework lainnya)
            [
                'discussion_id' => 1,
                'user_id' => 2, // Kontributor
                'content' => 'Laravel memiliki ecosystem yang sangat lengkap seperti Eloquent ORM, Blade templating, dan Artisan CLI. Dokumentasinya juga sangat baik dan komunitas sangat aktif.',
                'created_at' => now()->subDays(23),
                'updated_at' => now()->subDays(23),
            ],
            [
                'discussion_id' => 1,
                'user_id' => 5,
                'content' => 'Saya setuju! Plus, Laravel punya package manager Composer dan banyak package siap pakai. Development jadi lebih cepat.',
                'created_at' => now()->subDays(23),
                'updated_at' => now()->subDays(23),
            ],
            [
                'discussion_id' => 1,
                'user_id' => 1, // Admin
                'content' => 'Laravel juga lebih modern dengan support untuk features seperti queues, events, broadcasting, dll. Sangat cocok untuk aplikasi enterprise.',
                'created_at' => now()->subDays(22),
                'updated_at' => now()->subDays(22),
            ],
            
            // Replies to Discussion 2 (Laravel vs Node.js)
            [
                'discussion_id' => 2,
                'user_id' => 2,
                'content' => 'Tergantung kebutuhan project. Kalau tim sudah familiar dengan PHP, Laravel lebih cepat. Node.js bagus untuk real-time apps.',
                'created_at' => now()->subDays(22),
                'updated_at' => now()->subDays(22),
            ],
            [
                'discussion_id' => 2,
                'user_id' => 3,
                'content' => 'Saya lebih suka Laravel karena syntax-nya lebih clean dan ekspresif. Tapi memang Node.js performanya lebih baik untuk concurrent requests.',
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(21),
            ],
            
            // Replies to Discussion 3 (Error instalasi Laravel)
            [
                'discussion_id' => 3,
                'user_id' => 1,
                'content' => 'Kamu perlu install Composer dulu. Download dari getcomposer.org dan ikuti instruksi instalasi sesuai OS kamu.',
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(21),
            ],
            [
                'discussion_id' => 3,
                'user_id' => 4,
                'content' => 'Setelah install Composer, jangan lupa restart terminal atau command prompt supaya path-nya terupdate.',
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(21),
            ],
            [
                'discussion_id' => 3,
                'user_id' => 2,
                'content' => 'Untuk Windows, pastikan PHP sudah di PATH environment variable. Bisa di cek dengan command: php -v',
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
            [
                'discussion_id' => 3,
                'user_id' => 5,
                'content' => 'Terima kasih semuanya! Sudah berhasil. Ternyata PHP belum ada di PATH saya.',
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
            
            // Replies to Discussion 4 (Route naming)
            [
                'discussion_id' => 4,
                'user_id' => 2,
                'content' => 'Best practice: gunakan dot notation seperti "users.index", "users.show", "users.store". Konsisten dengan resource routing.',
                'created_at' => now()->subDays(19),
                'updated_at' => now()->subDays(19),
            ],
            [
                'discussion_id' => 4,
                'user_id' => 5,
                'content' => 'Jangan lupa juga untuk grouping route dengan prefix dan name. Contoh: Route::prefix(\'admin\')->name(\'admin.\')->group(...).',
                'created_at' => now()->subDays(18),
                'updated_at' => now()->subDays(18),
            ],
            
            // Replies to Discussion 5 (Resource vs Regular Controller)
            [
                'discussion_id' => 5,
                'user_id' => 2,
                'content' => 'Resource controller cocok untuk CRUD operations standar. Kalau perlu custom actions banyak, pakai regular controller.',
                'created_at' => now()->subDays(17),
                'updated_at' => now()->subDays(17),
            ],
            [
                'discussion_id' => 5,
                'user_id' => 1,
                'content' => 'Kamu juga bisa combine keduanya. Pakai resource untuk actions standar, tambahkan custom methods jika perlu.',
                'created_at' => now()->subDays(16),
                'updated_at' => now()->subDays(16),
            ],
            [
                'discussion_id' => 5,
                'user_id' => 5,
                'content' => 'Tips: gunakan php artisan route:list untuk melihat semua routes yang terdaftar dan pastikan naming-nya konsisten.',
                'created_at' => now()->subDays(16),
                'updated_at' => now()->subDays(16),
            ],
            
            // Replies to Discussion 6 (Migration rollback)
            [
                'discussion_id' => 6,
                'user_id' => 2,
                'content' => 'Coba cek tabel migrations di database. Pastikan ada records yang bisa di-rollback. Atau pakai --step untuk rollback batch tertentu.',
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
            [
                'discussion_id' => 6,
                'user_id' => 1,
                'content' => 'Kalau masih tidak bisa, coba php artisan migrate:status untuk lihat status migrations.',
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
            [
                'discussion_id' => 6,
                'user_id' => 3,
                'content' => 'Kadang issue di method down() migration. Pastikan down() method benar-benar reverse apa yang dilakukan di up().',
                'created_at' => now()->subDays(14),
                'updated_at' => now()->subDays(14),
            ],
            [
                'discussion_id' => 6,
                'user_id' => 4,
                'content' => 'Atau bisa juga pakai migrate:fresh --seed untuk reset semua dan seed ulang. Hati-hati, ini akan drop semua tables!',
                'created_at' => now()->subDays(14),
                'updated_at' => now()->subDays(14),
            ],
            [
                'discussion_id' => 6,
                'user_id' => 5,
                'content' => 'Problem solved! Ternyata migration batch-nya 0. Thanks for the help!',
                'created_at' => now()->subDays(13),
                'updated_at' => now()->subDays(13),
            ],
            
            // Replies to Discussion 7 (Migration kompleks)
            [
                'discussion_id' => 7,
                'user_id' => 2,
                'content' => 'Pecah migrations jadi smaller chunks. Buat separate migration untuk setiap logical change. Jangan campur terlalu banyak dalam satu file.',
                'created_at' => now()->subDays(13),
                'updated_at' => now()->subDays(13),
            ],
            
            // Replies to Discussion 8 (Vue 2 vs Vue 3)
            [
                'discussion_id' => 8,
                'user_id' => 2,
                'content' => 'Course ini menggunakan Vue 3. Perbedaan utama: Composition API, better TypeScript support, dan performance improvements.',
                'created_at' => now()->subDays(16),
                'updated_at' => now()->subDays(16),
            ],
            [
                'discussion_id' => 8,
                'user_id' => 5,
                'content' => 'Vue 3 juga lebih modular. Kamu bisa import hanya yang dibutuhkan, bundle size jadi lebih kecil.',
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
            
            // Replies to Discussion 9 (Component communication)
            [
                'discussion_id' => 9,
                'user_id' => 2,
                'content' => 'Untuk parent-child: gunakan props dan events. Untuk sibling atau complex state: consider Vuex atau Pinia.',
                'created_at' => now()->subDays(13),
                'updated_at' => now()->subDays(13),
            ],
            [
                'discussion_id' => 9,
                'user_id' => 1,
                'content' => 'Emit events untuk child-to-parent, props untuk parent-to-child. Simple and effective!',
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
            [
                'discussion_id' => 9,
                'user_id' => 3,
                'content' => 'Jangan lupa provide/inject untuk deeply nested components. Sangat berguna!',
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
            [
                'discussion_id' => 9,
                'user_id' => 5,
                'content' => 'Thanks! Saya akan coba implement dengan props dan events dulu sebelum pakai state management.',
                'created_at' => now()->subDays(11),
                'updated_at' => now()->subDays(11),
            ],
            
            // Replies to Discussion 10 (Singleton pattern use case)
            [
                'discussion_id' => 10,
                'user_id' => 1,
                'content' => 'Database connection adalah contoh klasik. Logger juga. Atau configuration manager untuk app settings.',
                'created_at' => now()->subDays(11),
                'updated_at' => now()->subDays(11),
            ],
            [
                'discussion_id' => 10,
                'user_id' => 4,
                'content' => 'Di Laravel, service container sudah handle banyak singleton cases. Tapi knowing the pattern tetap penting!',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],
            [
                'discussion_id' => 10,
                'user_id' => 2,
                'content' => 'Exactly! Laravel facade pattern sebenarnya menggunakan singleton di belakang layar.',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],
            
            // Replies to Discussion 11 (API Versioning)
            [
                'discussion_id' => 11,
                'user_id' => 2,
                'content' => 'URL versioning (api/v1/users) lebih straightforward dan easier to debug. Header versioning lebih clean tapi kompleks.',
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(8),
            ],
            [
                'discussion_id' => 11,
                'user_id' => 5,
                'content' => 'Saya prefer URL versioning. Client-side lebih mudah implement dan dokumentasinya lebih jelas.',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            
            // Replies to Discussion 12 (Rate limiting)
            [
                'discussion_id' => 12,
                'user_id' => 2,
                'content' => 'Laravel punya throttle middleware bawaan. Tinggal tambahkan di route: Route::middleware([\'throttle:60,1\']). 60 requests per minute.',
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
        ];

        DB::table('discussion_replies')->insert($replies);
    }
}