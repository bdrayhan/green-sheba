<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductColor>
 */
class ProductColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'color_name' => $color = fake()->unique()->colorName(),
            'color_url' => Str::slug($color, '-'),
            'color_code' => fake()->unique()->hexColor(),
            'color_slug' => uniqid(),
        ];
    }
}
