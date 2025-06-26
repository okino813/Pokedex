<?php

namespace Database\Factories;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
class CreaturesFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'pv' => fake()->numberBetween(0, 100),
            'atk' => fake()->numberBetween(0, 100),
            'def' => fake()->numberBetween(0, 100),
            'speed' => fake()->numberBetween(0, 100),
            'CreatureType' => fake()->randomElement(['ELECTRIK', 'WATER', 'FIRE']),
            'CreatureRace' => fake()->randomElement(['MOUSE', 'DRAGON', 'PLANT']),
            'capture_rate' => random_int(0, 100),
            'user_id' => random_int(1, User::count())

        ];
    }
}
