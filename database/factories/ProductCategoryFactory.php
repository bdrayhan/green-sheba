<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pc_name' => $category = fake()->unique()->firstNameFemale(),
            'pc_url' => Str::slug($category, '-'),
            'pc_remarks' => fake()->sentence(5),
            'pc_image' => fake()->imageUrl(400, 400, 'Category', true),
            'pc_feature' => 0,
            'pc_orderby' => rand(1, 10),
            'pc_active' => 1,
            'pc_creator' => 1,
            'pc_editor' => 1,
            'pc_slug' => uniqid(),
        ];
    }
}
