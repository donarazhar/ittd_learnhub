<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Lesson extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'module_id',
        'title',
        'slug',
        'content',
        'video_url',
        'video_duration',
        'order',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function attachments()
    {
        return $this->hasMany(LessonAttachment::class);
    }

    public function references()
    {
        return $this->hasMany(LessonReference::class)->orderBy('order');
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function notes()
    {
        return $this->hasMany(UserNote::class);
    }

    // Helper Methods
    public function isCompletedBy(User $user)
    {
        return $this->userProgress()
            ->where('user_id', $user->id)
            ->where('is_completed', true)
            ->exists();
    }

    public function getProgressFor(User $user)
    {
        return $this->userProgress()
            ->where('user_id', $user->id)
            ->first();
    }

    // app/Models/Lesson.php
    protected static function booted()
    {
        static::addGlobalScope('order', function ($builder) {
            $builder->orderBy('order');
        });
    }
    
}
