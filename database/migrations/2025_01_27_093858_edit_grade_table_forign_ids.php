<?php

use App\Models\Grade;
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
        Schema::table('grade', function (Blueprint $table) {

            $table->dropForeignIdFor(Grade::class, 'course_id');
            $table->dropForeignIdFor(Grade::class, 'student_id');
            $table->dropForeignIdFor(Grade::class, 'section_id');

            $table->foreign('course_id')->references('id')->on('course')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('student')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('section')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
