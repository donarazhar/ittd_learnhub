<?php
// routes/admin.php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')
    ->middleware(['auth'])
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Register (Admin only)
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
            ->middleware('admin')
            ->name('register');
        Route::post('/register', [RegisterController::class, 'register'])
            ->middleware('admin');

        // TinyMCE Image Upload
        Route::post('tinymce/upload', [ImageUploadController::class, 'upload'])->name('tinymce.upload');

        // Course Management
        Route::resource('courses', CourseController::class);
        Route::post('courses/{course}/publish', [CourseController::class, 'publish'])->name('courses.publish');
        Route::post('courses/{course}/unpublish', [CourseController::class, 'unpublish'])->name('courses.unpublish');

        // Module Management
        Route::post('courses/{course}/modules', [ModuleController::class, 'store'])->name('modules.store');
        Route::put('modules/{module}', [ModuleController::class, 'update'])->name('modules.update');
        Route::delete('modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');
        Route::post('modules/reorder', [ModuleController::class, 'reorder'])->name('modules.reorder');

        // Lesson Management
        Route::post('modules/{module}/lessons', [LessonController::class, 'store'])->name('lessons.store');
        Route::get('lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
        Route::put('lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
        Route::delete('lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
        Route::post('modules/{module}/lessons/reorder', [LessonController::class, 'reorder'])->name('lessons.reorder');

        // Forum Management
        Route::get('forum', [ForumController::class, 'index'])->name('forum.index');
        Route::get('forum/{discussion}', [ForumController::class, 'show'])->name('forum.show');
        Route::post('forum/{discussion}/toggle-pin', [ForumController::class, 'togglePin'])->name('forum.toggle-pin');
        Route::delete('forum/{discussion}', [ForumController::class, 'destroy'])->name('forum.destroy');
        Route::delete('forum/reply/{reply}', [ForumController::class, 'destroyReply'])->name('forum.destroy-reply');

        // User Management (Admin Only)
        Route::middleware('admin')->group(function () {
            Route::resource('users', UserController::class);
        });

        /*
    |--------------------------------------------------------------------------
    | Activity Logs
    |--------------------------------------------------------------------------
    */
        Route::prefix('activity-logs')->name('activity-logs.')->group(function () {
            Route::get('/', [ActivityLogController::class, 'index'])->name('index');
            Route::get('/{activity}', [ActivityLogController::class, 'show'])->name('show');
            Route::post('/clean', [ActivityLogController::class, 'clean'])->name('clean');
            Route::get('/export', [ActivityLogController::class, 'export'])->name('export');
            Route::get('/statistics', [ActivityLogController::class, 'statistics'])->name('statistics');
        });

        /*
    |--------------------------------------------------------------------------
    | Backups (Admin Only)
    |--------------------------------------------------------------------------
    */
        Route::middleware('admin')->prefix('backups')->name('backups.')->group(function () {
            Route::get('/', [BackupController::class, 'index'])->name('index');
            Route::post('/create', [BackupController::class, 'create'])->name('create');
            Route::get('/download/{file}', [BackupController::class, 'download'])->name('download');
            Route::delete('/{file}', [BackupController::class, 'destroy'])->name('destroy');
            Route::post('/clean', [BackupController::class, 'clean'])->name('clean');
            Route::get('/monitor', [BackupController::class, 'monitor'])->name('monitor');
        });

        // Analytics
        Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
        Route::get('analytics/courses/{course}', [AnalyticsController::class, 'courseDetail'])->name('analytics.course');
    });
