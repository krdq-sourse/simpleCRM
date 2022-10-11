<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // MODEL::inRandomOrder()->first()->id, не вариант по понятным причинам
            'user_id' =>  fake()->numberBetween(1, 10000),
            'company_id' => fake()->numberBetween(1, 10000),
        ];
    }
}
