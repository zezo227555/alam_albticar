<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('phone')->unique();
            $table->boolean('super')->default(false);
            $table->boolean('users_mangement')->default(false);
            $table->boolean('add_sections_courses')->default(false);
            $table->boolean('add_students')->default(false);
            $table->boolean('stop_students')->default(false);
            $table->boolean('student_marksheet_create')->default(false);
            $table->boolean('student_marksheet_see')->default(false);
            $table->boolean('grade_equation')->default(false);
            $table->boolean('add_employee')->default(false);
            $table->boolean('employee_salary_create')->default(false);
            $table->boolean('treasury_main')->default(false);
            $table->boolean('student_inroll')->default(false);
            $table->boolean('new_students')->default(false);
            $table->boolean('student_inrollment')->default(false);
            $table->boolean('employee_salary_see')->default(false);
            $table->boolean('treasury_all_report')->default(false);
            $table->boolean('mark_sheet_hide')->default(false);
            $table->boolean('season_colse_open')->default(false);
            $table->boolean('show_graduated')->default(false);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
