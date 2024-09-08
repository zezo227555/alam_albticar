<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grade';
    protected $fillable = [
        'student_id', 'section_id', 'season_id', 'course_id', 'resault'
    ];

    public function student() : BelongsTo {
        return $this->belongsTo(Student::class);
    }

    public function course() : BelongsTo {
        return $this->belongsTo(Course::class);
    }

    public function season() : BelongsTo {
        return $this->belongsTo(Season::class);
    }

    public function section() : BelongsTo {
        return $this->belongsTo(Section::class);
    }
}
