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
        Schema::table('student_fees', function (Blueprint $table) {
            $table->decimal('amount_due', 10, 2)->change(); // Change to decimal with precision 10, scale 2
            $table->decimal('amount_paid', 10, 2)->change(); // Change to decimal with precision 10, scale 2
            $table->decimal('balance', 10, 2)->change(); // Change to decimal with precision 10, scale 2
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_fees', function (Blueprint $table) {
            Schema::table('student_fees', function (Blueprint $table) {
                $table->integer('amount_due')->change(); // Revert to integer
                $table->integer('amount_paid')->change(); // Revert to integer
                $table->integer('balance')->change(); // Revert to integer
            });
        });
    }
};
