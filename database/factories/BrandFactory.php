<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'brand_name' => $brand = fake()->unique()->word(),
            'brand_image' => fake()->imageUrl(330, 88, 'Brand', true),
            'brand_url' => Str::slug($brand, '-'),
            'brand_feature' => 1,
            'brand_slug' => uniqid(),
        ];
    }
}
