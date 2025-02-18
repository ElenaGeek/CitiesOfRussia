<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CityImage>
 */
class CityImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'city_id' => rand(1, 20),
            'image_id' => rand(1, 400),
            'description' => $this->faker->text(150),
        ];
    }
}
