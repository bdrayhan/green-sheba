<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_name' => $name = fake()->unique()->sentence(4),
            'product_url' => Str::slug($name, '-'),
            'product_slug' => uniqid(),
            'product_code' => rand(11111, 66666),
            'product_thumbnail' => '/frontend/assets/images/products/0'. rand(1, 9) .'.png',
            'product_featured' => 1,
            'product_hotDeal' => 1,
            'product_best_rated' => 1,
            'product_trending' => 1,
            'product_warranty' => rand(0, 1),
            'product_back_order' => rand(0, 1),
            'product_regular_price' => fake()->numberBetween($min = 1500, $max = 2500),
            'product_discount_price' => fake()->numberBetween($min = 1000, $max = 1500),
            'product_quantity' => fake()->randomNumber(2),
            'min_quantity' => 1,
            'product_stock_status' => 1,
            'delivery_location' => 'bangladesh',
            'product_active' => 1,
            'product_short_details' => fake()->paragraph(2),
            'product_details' => fake()->paragraph(10),
            'product_video_link' => fake()->url(),
            'product_status' => 1,
        ];
    }
}
