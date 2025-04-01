<?php

namespace Database\Factories;
use App\Models\Fee;
use App\Models\Academic_Session;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Category;
use App\Models\Level;
use App\Models\Entry_Mode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fee>
 */
class FeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Fee::class;
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            // 'name' => $this->faker->word,
            'name' => $this->faker->unique()->randomElement([
                'Lab Fee',
                'Tuition Fee',
                'X-ray Fee',
                'Sport Fee',
                'Exam Fee',
                'Medical Fee',
            ]),
            'description' => $this->faker->sentence,
            'academic_session_id' => Academic_Session::inRandomOrder()->first()->id ?? Academic_Session::factory(),
            'department_id' => Department::inRandomOrder()->first()->id ?? Department::factory(),
            'faculty_id' => Faculty::inRandomOrder()->first()->id ?? Faculty::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'level_id' => Level::inRandomOrder()->first()->id ?? Level::factory(),
            'entry_mode_id' => Entry_Mode::inRandomOrder()->first()->id ?? Entry_Mode::factory(),
            'amount' => $this->faker->randomFloat(2, 1000, 10000),
            'payment_start_date' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'payment_close_date' => $this->faker->dateTimeBetween('now', '+3 months'),
        ];
    }
}
