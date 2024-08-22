<?php

namespace Database\Factories;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SolarForm>
 */
class SolarFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hasSolar' => fake()->boolean(),
            'panel_count' => fake()->randomDigit(),
            'status' => fake()->randomElement(array_column(StatusEnum::cases(),'value')), //Pick random status enum
        ];
    }
}
