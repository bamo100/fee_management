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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->uuid('faculty_id')->constrained('faculties', 'id')->cascadeOnDelete();
            $table->uuid('department_id')->constrained('departments', 'id')->cascadeOnDelete();
            $table->uuid('academic_session_id')->constrained('academic_sessions', 'id')->cascadeOnDelete();
            $table->uuid('level_id')->constrained('levels', 'id')->cascadeOnDelete();
            $table->uuid('category_id')->constrained('categories', 'id')->cascadeOnDelete();
            $table->uuid('entry_mode_id')->constrained('entry_modes', 'id')->cascadeOnDelete();
            $table->string('matric_number')->unique();
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
