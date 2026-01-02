<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'user_id',
        'title',
        'content',
        'is_pinned',
        'replies_count',
    ];

    protected function casts(): array
    {
        return [
            'is_pinned' => 'boolean',
            'replies_count' => 'integer',
        ];
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(DiscussionReply::class);
    }

    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }
}
