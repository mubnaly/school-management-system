<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // 'usertype',
        'code',
        'role',
        'mobile',
        'address',
        'gender',
        'image',
        'religion',
        'id_no',
        'birth',
        'join_date',
        'designation_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    // NEW RELATIONSHIPS FOR COURSE PLATFORM
    public function taughtCourses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withPivot('paid_amount', 'payment_status', 'enrolled_at', 'completed_at', 'progress')
                    ->withTimestamps();
    }

    public function lessonProgress()
    {
        return $this->hasMany(LessonProgress::class);
    }

    // Scope for instructors
    public function scopeInstructors($query)
    {
        return $query->where('role', 'instructor');
    }

    // Scope for students
    public function scopeStudents($query)
    {
        return $query->where('role', 'student');
    }

    // Check if user is instructor
    public function isInstructor()
    {
        return $this->role === 'instructor';
    }

    // Check if user is student
    public function isStudent()
    {
        return $this->role === 'student';
    }
}
