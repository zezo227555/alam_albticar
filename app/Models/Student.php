<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'student';

    protected $fillable = [
        'name', 'nationla_id', 'phone', 'nationality', 'section_id', 'attendance_type', 'gender', 'student_semester'
        ,'season_id', 'st_id', 'perant_phone', 'active', 'graduated', 'fees',
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

    public function season() : BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
