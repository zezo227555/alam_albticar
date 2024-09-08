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
        'type', 'value', 'season_id', 'student_id'
    ];

    public function student() : BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function season() : BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
