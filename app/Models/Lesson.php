<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'title',
        'description',
        'video_url',
        'duration',
        'order',
        'is_preview',
        'resources',
    ];

    protected $casts = [
        'is_preview' => 'boolean',
        'resources' => 'array',
    ];

    // Relationships
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function course()
    {
        return $this->hasOneThrough(Course::class, Section::class, 'id', 'id', 'section_id', 'course_id');
    }

    public function progress()
    {
        return $this->hasMany(LessonProgress::class);
    }
}
