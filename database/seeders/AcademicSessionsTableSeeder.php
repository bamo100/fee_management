<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AcademicSessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sessions = [
            ['id' => Str::uuid(), 'session_name' => '2024/2025', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => Str::uuid(), 'session_name' => '2025/2026', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => Str::uuid(), 'session_name' => '2026/2027', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('academic_sessions')->insert($sessions);
    }
}
