<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => $this->faker->company(),
            'model' => $this->faker->word(),
            'license_plate' => strtoupper($this->faker->bothify('???####')),
            'hourly_rate' => $this->faker->randomFloat(2, 5, 100),
            'provider_id' => User::factory()->state(['role' => User::ROLE_PROVIDER]),
        ];
    }
}
