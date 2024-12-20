<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';

    protected $fillable = [
        'name', 'type', 'salary', 'mangement_id', 'phone'
    ];

    public function mangement() : BelongsTo
    {
        return $this->belongsTo(Mangement::class);
    }

    public function treasury() : HasMany
    {
        return $this->hasMany(Treasury::class);
    }
}
