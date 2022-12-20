<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicRecord>
 */
class AcademicRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dues' => 2500,
            'level' => fake()->randomElement([100, 200, 300, 400]),
            'paid' => random_int(0, 1)
        ];
    }
}
