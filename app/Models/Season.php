<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    use HasFactory;

    protected $table = 'season';

    protected $fillable = [
        'name', 'end_date', 'active'
    ];

    public function tressury() : HasMany
    {
        return $this->hasMany(Treasury::class);
    }
}
