<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['id' => Str::uuid(), 'level_name' => '100level', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'level_name' => '200level', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'level_name' => '300level', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'level_name' => '400level', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'level_name' => '500level', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('levels')->insert($levels);
    }
}
