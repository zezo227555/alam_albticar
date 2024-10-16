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
        Schema::table('employee', function (Blueprint $table) {
            $table->dropConstrainedForeignId('section_id');
            $table->dropColumn('type');
            $table->foreignId('mangement_id')->nullable()->constrained('mangement')->nullOnDelete();
        });
    }
};
