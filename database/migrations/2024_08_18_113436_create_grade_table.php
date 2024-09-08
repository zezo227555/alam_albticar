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
            $table->foreignId('student_id')->constrained('student');
            $table->foreignId('section_id')->constrained('section');
            $table->foreignId('season_id')->constrained('season');
            $table->float('resault')->default(0);
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
