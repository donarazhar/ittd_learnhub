<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForumController;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Courses
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::post('/courses/{course}/review', [CourseController::class, 'review'])->name('courses.review');

    // Learning
    Route::get('/learn/{courseSlug}/{lessonSlug}', [LearnController::class, 'show'])->name('learn.show');
    Route::post('/learn/progress', [LearnController::class, 'updateProgress'])->name('learn.progress');
    Route::post('/learn/notes', [LearnController::class, 'saveNote'])->name('learn.notes');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-courses', [DashboardController::class, 'myCourses'])->name('my-courses');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Forum
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::post('/discussions', [ForumController::class, 'store'])->name('discussions.store');
    Route::post('/discussions/{discussion}/reply', [ForumController::class, 'reply'])->name('discussions.reply');
});

// Admin & Kontributor Routes
require __DIR__ . '/admin.php';
