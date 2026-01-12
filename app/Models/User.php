<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
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

    protected function getLogAttributes(): array
    {
        return [
            'name',
            'email',
            'employee_id',
            'role',
            'is_active',
        ];
    }

    protected function getActivityDescription(string $eventName): string
    {
        $userName = auth()->user()?->name ?? 'System';

        return match ($eventName) {
            'created' => "{$userName} mendaftarkan user baru: {$this->name} ({$this->email})",
            'updated' => "{$userName} mengupdate data user: {$this->name}",
            'deleted' => "{$userName} menghapus user: {$this->name}",
            default => "{$userName} melakukan {$eventName} pada user: {$this->name}",
        };
    }

    public function logLogin(): void
    {
        activity()
            ->causedBy($this)
            ->performedOn($this)
            ->withProperties([
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ])
            ->log("{$this->name} login ke sistem");
    }

    public function logLogout(): void
    {
        activity()
            ->causedBy($this)
            ->performedOn($this)
            ->withProperties([
                'ip' => request()->ip(),
            ])
            ->log("{$this->name} logout dari sistem");
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

    public function isUser(): bool
    {
        return $this->role === 'user';
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
