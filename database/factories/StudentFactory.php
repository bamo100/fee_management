<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Student;
use App\Models\Fee;
use App\Models\Academic_Session;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Category;
use App\Models\Level;
use App\Models\Entry_Mode;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->unique()->phoneNumber,
            'faculty_id' => Faculty::inRandomOrder()->first()->id,
            'department_id' => Department::inRandomOrder()->first()->id,
            'academic_session_id' => Academic_Session::inRandomOrder()->first()->id,
            'level_id' => Level::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'entry_mode_id' => Entry_Mode::inRandomOrder()->first()->id,
            'matric_number' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{4}'),
            'password' => bcrypt('password'), // Default password for all seeded users
            'profile_picture' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
