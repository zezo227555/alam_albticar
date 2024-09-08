<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;
    protected $table = "section";
    protected $fillable = [
        'name', 'level',
    ];

    public function student() : HasMany
    {
        return $this->hasMany(Student::class);
    }
    public function course() : HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function employee() : HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
