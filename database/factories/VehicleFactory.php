<?php

namespace Database\Factories;

use App\Models\Mark;
use App\Models\Type;
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
            'placa' => fake()->unique()->regexify("/^[A-Z]{3}\d{2}[A-Z]{2}$/"), // Ej: LAC26M
            'year' => fake()->year(),
            'color' => fake()->randomElement(['rojo','blanco','negro','azul','amarillo','gris','verde']),
            'date_entry' => fake()->date(),
            'mark_id' => function () {
                return Mark::factory()->create()->id;
            },
            'type_id' => function () {
                return Type::factory()->create()->id;
            }
        ];
    }
}
