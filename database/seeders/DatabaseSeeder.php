<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Employee;
use App\Models\Mangement;
use App\Models\Season;
use App\Models\Section;
use App\Models\Student;
use App\Models\Treasury;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // DB::table("users")->insert([
        //     'name' => 'zidan',
        //     'username' => 'zidan',
        //     'phone' => '092-0000000',
        //     'users_mangement' => true,
        //     'super' => true,
        //     'add_sections_courses' => true,
        //     'add_students' => true,
        //     'stop_students' => true,
        //     'student_marksheet_create' => true,
        //     'student_marksheet_see' => true,
        //     'grade_equation' => true,
        //     'add_employee' => true,
        //     'employee_salary_create' => true,
        //     'treasury_main' => true,
        //     'student_inroll' => true,
        //     'new_students' => true,
        //     'student_inrollment' => true,
        //     'employee_salary_see' => true,
        //     'treasury_all_report' => true,
        //     'mark_sheet_hide' => true,
        //     'season_colse_open' => true,
        //     'show_graduated' => true,
        //     'password' => Hash::make('zidan227'),
        //     'created_at' => Carbon::now(),
        // ]);

        // DB::table("users")->insert([
        //     'name' => 'مفتاح',
        //     'username' => 'moftah',
        //     'phone' => '092-0000001',
        //     'users_mangement' => true,
        //     'password' => Hash::make('zidan12345678'),
        //     'created_at' => Carbon::now(),
        // ]);

        // Season::create([
        //     'name' => 'صيف',
        //     'active' => true,
        // ]);

        // Section::create([
        //     'name' => 'حاسوب',
        //     'level' => 'عالي',
        // ]);

        // Section::create([
        //     'name' => 'محاسبة',
        //     'level' => 'عالي',
        // ]);

        // Mangement::create([
        //     'name' => 'الادارة العامة',
        // ]);

        // for($i = 1; $i <= 6; $i++) {
        //     Course::create([
        //         'name' => "CS $i",
        //         'semester' => $i,
        //         'section_id' => 1,
        //     ]);
        // }

        // Employee::create([
        //     'name' => "employee $i",
        //     'salary' => '3000',
        //     'phone' => '092-1',
        //     'mangement_id' => 1,
        // ]);

        // for($i = 0; $i <= 300; $i++){
        //     Student::create([
        //         'st_id' => $i,
        //         'name' => "student $i",
        //         'nationla_id' => "1209$i",
        //         'phone' => "092-$i",
        //         'nationality' => 'ليبي',
        //         'perant_phone' => "092-$i",
        //         'gender' => 'ذكر',
        //         'section_id' => 1,
        //         'season_id' => 1,
        //         'attendance_type' => 'نظامي',
        //     ]);
        // }

        // for($i = 400; $i <= 700; $i++){
        //     Student::create([
        //         'st_id' => $i,
        //         'name' => "student $i",
        //         'nationla_id' => "1209$i",
        //         'phone' => "092-$i",
        //         'nationality' => 'ليبي',
        //         'perant_phone' => "092-$i",
        //         'gender' => 'ذكر',
        //         'section_id' => 2,
        //         'season_id' => 1,
        //         'attendance_type' => 'نظامي',
        //     ]);
        // }

        for($i = 0; $i < 10000; $i++) {
            Treasury::create([
                'type' => 'قبض',
                'value' => 1,
                'season_id' => 1,
                'user_id' => 1,
            ]);
        }
    }
}
