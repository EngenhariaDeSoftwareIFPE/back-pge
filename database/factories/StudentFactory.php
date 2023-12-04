<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    
    {
        return [
            'matricula' => $this->faker->unique()->numerify('#####ewbj####'),
            'nome' => $this->faker->name(),
            'curso' => $this->faker->randomElement(['Licenciatura em Música', 'Técnico em Agropecuária', 'Técnico em Agroindústria']),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
