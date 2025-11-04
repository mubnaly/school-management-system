<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'instructor_id',
        'price',
        'discount_price',
        'thumbnail',
        'promo_video',
        'level',
        'language',
        'certificate_included',
        'total_duration',
        'total_lessons',
        'requirements',
        'what_you_learn',
        'status',
        'featured',
    ];

    protected $casts = [
        'requirements' => 'array',
        'what_you_learn' => 'array',
        'certificate_included' => 'boolean',
        'featured' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    // Relationships
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'course_category');
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Section::class);
    }
}
