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
        Schema::create('grade', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('course');
            $table->foreignId('student_id')->constrained('student')->cascadeOnDelete();
            $table->foreignId('section_id')->constrained('section');
            $table->foreignId('season_id')->constrained('season');
            $table->boolean('active');
            $table->boolean('show_grades')->default(false);
            $table->float('final')->default(0);
            $table->float('semester_work')->default(0);
            $table->float('total')->default(0);
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade');
    }
};
