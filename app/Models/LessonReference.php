<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonReference extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'lesson_id',
        'title',
        'url',
        'type',
        'order',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
