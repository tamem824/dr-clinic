<?php

namespace Database\Factories;

use App\Models\employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->jobTitle(),
            'employer_id'=> employer::factory(),
            'salary' => '50000 $',
            'created_at'=>now(),
            'updated_at'=>now()

            //
        ];
    }
}
