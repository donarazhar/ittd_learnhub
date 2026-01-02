<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Course extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'created_by',
        'title',
        'slug',
        'description',
        'thumbnail',
        'level',
        'estimated_duration',
        'status',
        'total_enrolled',
        'average_rating',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'average_rating' => 'decimal:2',
            'total_enrolled' => 'integer',
        ];
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function modules()
    {
        return $this->hasMany(Module::class)->orderBy('order');
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Module::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->withPivot('enrolled_at', 'completed_at', 'progress_percentage')
            ->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(CourseReview::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    // Helper Methods
    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function getTotalLessonsAttribute()
    {
        return $this->lessons()->count();
    }

    public function updateAverageRating()
    {
        $this->average_rating = $this->reviews()->avg('rating') ?? 0;
        $this->save();
    }

    public function incrementEnrollment()
    {
        $this->increment('total_enrolled');
    }
}
