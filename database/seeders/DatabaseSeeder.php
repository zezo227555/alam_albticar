<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Employee;
use App\Models\Season;
use App\Models\Section;
use App\Models\Student;
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
        DB::table("users")->insert([
            'name' => 'zidan',
            'username' => 'zidan',
            'role' => 'super_admin',
            'phone' => '092-0000000',
            'password' => Hash::make('zidan227'),

        ]);

        Season::create([
            'name' => 'صيف',
            'active' => true,
        ]);

        Section::create([
            'name' => 'حاسوب',
            'level' => 'عالي',
        ]);

        Section::create([
            'name' => 'محاسبة',
            'level' => 'عالي',
        ]);

        Course::create([
            'name' => 'اساسيات برمجة',
            'semester' => 1,
            'section_id' => 1,
        ]);

        Course::create([
            'name' => 'رياضيات',
            'semester' => 1,
            'section_id' => 1,
        ]);

        Employee::create([
            'name' => 'employee',
            'type' => 'موظف اداري',
            'salary' => '3000',
            'phone' => '092-1',
            'section_id' => 1,
        ]);

        Employee::create([
            'name' => 'teatcher',
            'type' => 'عضو هيئة تدريس',
            'salary' => '2500',
            'phone' => '092-0',
            'section_id' => 1,
        ]);

        Employee::create([
            'name' => 'employee',
            'type' => 'موظف اداري',
            'salary' => '3000',
            'phone' => '092-3',
            'section_id' => 2,
        ]);

        Employee::create([
            'name' => 'teatcher',
            'type' => 'عضو هيئة تدريس',
            'salary' => '2500',
            'phone' => '092-4',
            'section_id' => 2,
        ]);

        for($i = 0; $i <= 3; $i++){
            Student::create([
                'st_id' => $i,
                'name' => "student $i",
                'nationla_id' => "1209$i",
                'phone' => "092-$i",
                'nationality' => 'ليبي',
                'perant_phone' => "092-$i",
                'gender' => 'ذكر',
                'section_id' => 1,
                'season_id' => 1,
                'attendance_type' => 'نظامي',
            ]);
        }

        for($i = 4; $i <= 7; $i++){
            Student::create([
                'st_id' => $i,
                'name' => "student $i",
                'nationla_id' => "1209$i",
                'phone' => "092-$i",
                'nationality' => 'ليبي',
                'perant_phone' => "092-$i",
                'gender' => 'ذكر',
                'section_id' => 2,
                'season_id' => 1,
                'attendance_type' => 'نظامي',
            ]);
        }
    }
}
