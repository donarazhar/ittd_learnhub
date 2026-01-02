<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'employee_id',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function courses()
    {
        return $this->hasMany(Course::class, 'created_by');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
            ->withPivot('enrolled_at', 'completed_at', 'progress_percentage')
            ->withTimestamps();
    }

    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function notes()
    {
        return $this->hasMany(UserNote::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function replies()
    {
        return $this->hasMany(DiscussionReply::class);
    }

    public function reviews()
    {
        return $this->hasMany(CourseReview::class);
    }

    public function activities()
    {
        return $this->hasMany(UserActivity::class);
    }

    // Helper Methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isKontributor()
    {
        return $this->role === 'kontributor';
    }

    public function canManageCourse(Course $course)
    {
        return $this->isAdmin() || $course->created_by === $this->id;
    }

    public function hasEnrolled(Course $course)
    {
        return $this->enrollments()->where('course_id', $course->id)->exists();
    }
}
