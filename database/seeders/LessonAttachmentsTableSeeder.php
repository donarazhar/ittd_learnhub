<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonAttachmentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $attachments = [
            [
                'lesson_id' => 1,
                'file_name' => 'Laravel Cheatsheet.pdf',
                'file_path' => 'attachments/laravel-cheatsheet.pdf',
                'file_type' => 'application/pdf',
                'file_size' => 2457600, // ~2.4 MB
                'created_at' => now(),
            ],
            [
                'lesson_id' => 2,
                'file_name' => 'Laravel Installation Guide.pdf',
                'file_path' => 'attachments/laravel-installation.pdf',
                'file_type' => 'application/pdf',
                'file_size' => 1048576, // 1 MB
                'created_at' => now(),
            ],
            [
                'lesson_id' => 3,
                'file_name' => 'Directory Structure Diagram.png',
                'file_path' => 'attachments/directory-structure.png',
                'file_type' => 'image/png',
                'file_size' => 524288, // 512 KB
                'created_at' => now(),
            ],
            [
                'lesson_id' => 4,
                'file_name' => 'Routing Examples.zip',
                'file_path' => 'attachments/routing-examples.zip',
                'file_type' => 'application/zip',
                'file_size' => 3145728, // 3 MB
                'created_at' => now(),
            ],
            [
                'lesson_id' => 7,
                'file_name' => 'Database Config Sample.txt',
                'file_path' => 'attachments/db-config.txt',
                'file_type' => 'text/plain',
                'file_size' => 2048, // 2 KB
                'created_at' => now(),
            ],
            [
                'lesson_id' => 8,
                'file_name' => 'Migration Code Examples.php',
                'file_path' => 'attachments/migration-examples.php',
                'file_type' => 'text/plain',
                'file_size' => 8192, // 8 KB
                'created_at' => now(),
            ],
            [
                'lesson_id' => 9,
                'file_name' => 'Vue.js Quick Reference.pdf',
                'file_path' => 'attachments/vuejs-reference.pdf',
                'file_type' => 'application/pdf',
                'file_size' => 1572864, // ~1.5 MB
                'created_at' => now(),
            ],
            [
                'lesson_id' => 11,
                'file_name' => 'Component Templates.zip',
                'file_path' => 'attachments/component-templates.zip',
                'file_type' => 'application/zip',
                'file_size' => 4194304, // 4 MB
                'created_at' => now(),
            ],
            [
                'lesson_id' => 12,
                'file_name' => 'Design Patterns UML.pdf',
                'file_path' => 'attachments/design-patterns-uml.pdf',
                'file_type' => 'application/pdf',
                'file_size' => 2097152, // 2 MB
                'created_at' => now(),
            ],
            [
                'lesson_id' => 14,
                'file_name' => 'PHPUnit Configuration.xml',
                'file_path' => 'attachments/phpunit.xml',
                'file_type' => 'application/xml',
                'file_size' => 4096, // 4 KB
                'created_at' => now(),
            ],
            [
                'lesson_id' => 15,
                'file_name' => 'REST API Best Practices.pdf',
                'file_path' => 'attachments/rest-best-practices.pdf',
                'file_type' => 'application/pdf',
                'file_size' => 3670016, // ~3.5 MB
                'created_at' => now(),
            ],
            [
                'lesson_id' => 17,
                'file_name' => 'JWT Implementation Guide.pdf',
                'file_path' => 'attachments/jwt-guide.pdf',
                'file_type' => 'application/pdf',
                'file_size' => 1835008, // ~1.75 MB
                'created_at' => now(),
            ],
        ];

        DB::table('lesson_attachments')->insert($attachments);
    }
}