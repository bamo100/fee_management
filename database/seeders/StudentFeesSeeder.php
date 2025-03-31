<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class StudentFeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Retrieve all student and fee IDs from the database
        $studentIds = DB::table('students')->pluck('id')->toArray();
        $feeIds = DB::table('fees')->pluck('id')->toArray();

        // Ensure there are students and fees to associate
        if (empty($studentIds) || empty($feeIds)) {
            $this->command->info('No students or fees found in the database. Seeding aborted.');
            return;
        }

        $data = [];

        for ($i = 0; $i < 1000; $i++) {
            $amountDue = $faker->numberBetween(1000, 10000);
            $amountPaid = $faker->numberBetween(0, $amountDue);
            $balance = $amountDue - $amountPaid;
            $status = $balance == 0 ? 'approved' : $faker->randomElement(['pending', 'rejected']);
            $paymentDueDate = $faker->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d');

            $data[] = [
                'id' => Str::uuid(),
                'student_id' => $faker->randomElement($studentIds),
                'fee_id' => $faker->randomElement($feeIds),
                'amount_due' => $amountDue,
                'amount_paid' => $amountPaid,
                'balance' => $balance,
                'status' => $status,
                'payment_due_date' => $paymentDueDate,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the generated data into the student_fees table
        DB::table('student_fees')->insert($data);
    }
}
