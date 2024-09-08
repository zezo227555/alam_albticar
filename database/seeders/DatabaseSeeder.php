<?php

namespace Database\Seeders;

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
            'level' => 'عالي'
        ]);

        for($i = 0; $i <= 100; $i++){
            Student::create([
                'name' => "student $i",
                'nationla_id' => "1209$i",
                'phone' => "092-$i",
                'nationality' => 'ليبي',
                'gender' => 'ذكر',
                'section_id' => 1,
                'attendance_type' => 'نظامي'
            ]);
        }
    }
}
