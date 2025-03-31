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
        Schema::create('student_fees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id')->constrained('students', 'id')->cascadeOnDelete();
            $table->uuid('fee_id')->constrained('fees', 'id')->cascadeOnDelete();
            $table->decimal('amount_due');
            $table->decimal('amount_paid');
            $table->decima('balance');
            $table->enum('status', ['approved', 'pending', 'rejected'])->default('pending');
            $table->date('payment_due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_fees');
    }
};
