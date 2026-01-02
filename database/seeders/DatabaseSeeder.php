<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CoursesTableSeeder::class,
            ModulesTableSeeder::class,
            LessonsTableSeeder::class,
            LessonAttachmentsTableSeeder::class,
            LessonReferencesTableSeeder::class,
            EnrollmentsTableSeeder::class,
            UserProgressTableSeeder::class,
            UserNotesTableSeeder::class,
            DiscussionsTableSeeder::class,
            DiscussionRepliesTableSeeder::class,
            CourseReviewsTableSeeder::class,
            UserActivitiesTableSeeder::class,
        ]);
    }
}
