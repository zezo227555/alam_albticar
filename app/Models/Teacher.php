<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teacher';

    protected $fillable = [
        'name', 'degree', 'phone',
    ];

    public function teacherCourses() : HasMany
    {
        return $this->hasMany(TeacherCourses::class);
    }

    public function treasury() : HasMany
    {
        return $this->hasMany(Treasury::class);
    }
}
