<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $table = "course";

    protected $fillable = [
        'name', 'semester', 'section_id',
    ];

    public function section() : BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function grade() : HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
