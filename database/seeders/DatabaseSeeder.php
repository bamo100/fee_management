<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(AcademicSessionsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(EntryModesTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(FacultiesTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(FeeSeeder::class);
        $this->call(StudentFeesSeeder::class);
    }
}
