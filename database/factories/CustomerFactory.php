<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $email = $this->faker->unique()->safeEmail();

        return [
            'name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $email,
            'password' => bcrypt($email), // password igual al email
            'accumulated_points' => $this->faker->numberBetween(0, 500),
            'phone' => $this->faker->phoneNumber(),
            'image' => null,
            'remember_token' => Str::random(10),
        ];
    }
}
