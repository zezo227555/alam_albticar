<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'password',
        'add_sections_courses', 'add_students', 'stop_students', 'student_marksheet_create', 'student_marksheet_see', 'add_employee',
        'employee_salary_create', 'treasury_main', 'users_mangement',
        'student_inroll', 'new_students', 'student_inrollment', 'employee_salary_see', 'treasury_all_report', 'mark_sheet_hide',
        'season_colse_open', 'grade_equation', 'show_graduated',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
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
