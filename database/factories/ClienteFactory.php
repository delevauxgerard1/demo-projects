<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombres' => fake()->name(),
            'apellidos' => fake()->lastName(),
            'domicilio' => fake()->address(),
            'tel_movil' => $this->faker->numberBetween(3815000000,3815999999),
            'profesion' => $this->faker->randomElement(['Front-End', 'Back-End', 'Full Stack', 'Teach Lead', 'Manager']),
            'email' => $this->faker->unique()->email
        ];
    }
}
