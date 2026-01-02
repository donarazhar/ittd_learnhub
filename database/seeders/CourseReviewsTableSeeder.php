<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseReviewsTableSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            // Reviews for Course 1: Laravel Fundamental
            [
                'course_id' => 1,
                'user_id' => 3,
                'rating' => 5,
                'review' => 'Course yang sangat bagus untuk pemula! Penjelasannya detail dan mudah dipahami. Video-videonya berkualitas tinggi dan materinya sangat terstruktur.',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'course_id' => 1,
                'user_id' => 4,
                'rating' => 4,
                'review' => 'Materi lengkap dan instructor-nya menjelaskan dengan baik. Sedikit saran: tambahkan lebih banyak real-world examples.',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],
            [
                'course_id' => 1,
                'user_id' => 5,
                'rating' => 5,
                'review' => 'Excellent course! Setelah selesai course ini, saya bisa langsung bikin project Laravel sendiri. Highly recommended!',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            
            // Reviews for Course 2: Vue.js for Beginners
            [
                'course_id' => 2,
                'user_id' => 3,
                'rating' => 5,
                'review' => 'Vue.js jadi mudah dipahami berkat course ini. Pace-nya pas, tidak terlalu cepat atau lambat. Love it!',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'course_id' => 2,
                'user_id' => 5,
                'rating' => 5,
                'review' => 'Best Vue.js course yang pernah saya ikuti! Clear explanations dan hands-on exercises yang sangat membantu.',
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(8),
            ],
            [
                'course_id' => 2,
                'user_id' => 1,
                'rating' => 4,
                'review' => 'Good course overall. Covers fundamentals dengan baik. Mungkin bisa ditambahkan module tentang Vuex untuk state management.',
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
            
            // Reviews for Course 3: Advanced PHP Programming
            [
                'course_id' => 3,
                'user_id' => 4,
                'rating' => 5,
                'review' => 'Mind-blowing! Design patterns explained dengan sangat baik. Ini mengubah cara saya menulis code.',
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
            [
                'course_id' => 3,
                'user_id' => 2,
                'rating' => 5,
                'review' => 'Advanced level tapi tetap bisa dipahami. TDD section-nya particularly useful untuk improve code quality.',
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            
            // Reviews for Course 4: RESTful API Development
            [
                'course_id' => 4,
                'user_id' => 3,
                'rating' => 5,
                'review' => 'Perfect course untuk belajar API development! Security practices dan best practices-nya sangat valuable.',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'course_id' => 4,
                'user_id' => 5,
                'rating' => 4,
                'review' => 'Solid course. Authentication dengan JWT dijelaskan dengan sangat baik. Saya sekarang confident untuk build production-ready API.',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
        ];

        DB::table('course_reviews')->insert($reviews);
    }
}