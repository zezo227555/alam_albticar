<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherCourses extends Model
{
    use HasFactory;

    protected $table = 'teacher_courses';

    protected $fillable = [
        'course_id', 'teacher_id', 'section_id',
    ];

    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher() : BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function section() : BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
