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
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('st_id')->unique();
            $table->string('name', 50);
            $table->string('nationla_id', 20)->unique();
            $table->string('phone', 20);
            $table->string('perant_phone', 20)->nullable();
            $table->string('nationality', 20);
            $table->string('gender', 15);
            $table->integer('student_semester')->default(1);
            $table->foreignId('section_id')->constrained('section');
            $table->string('attendance_type', 10);
            $table->boolean('active')->default(true);
            $table->boolean('graduated')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
