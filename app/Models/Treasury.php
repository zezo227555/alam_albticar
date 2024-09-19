<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Treasury extends Model
{
    use HasFactory;

    protected $table = 'treasury';

    protected $fillable = [
        'type', 'value', 'section_id', 'season_id', 'student_id', 'employee_id', 'user_id'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function section() : BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function student() : BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function employee() : BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function season() : BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
