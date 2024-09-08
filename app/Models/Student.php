<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $fillable = [
        'name', 'nationla_id', 'phone', 'nationality', 'section_id', 'attendance_type', 'gender', 'student_semester'
    ];

    public function section() : BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function grade() : HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function treasury() : HasMany
    {
        return $this->hasMany(Treasury::class);
    }
}
