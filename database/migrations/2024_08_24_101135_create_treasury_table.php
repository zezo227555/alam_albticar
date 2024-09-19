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
        Schema::create('treasury', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->float('value');
            $table->foreignId('season_id')->constrained('season');
            $table->foreignId('section_id')->nullable()->constrained('section');
            $table->foreignId('student_id')->nullable()->constrained('student');
            $table->foreignId('employee_id')->nullable()->constrained('employee');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tresury');
    }
};
