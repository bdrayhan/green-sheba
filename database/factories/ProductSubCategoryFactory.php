<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSubCategory>
 */
class ProductSubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => ProductCategory::all()->random()->id,
            'psc_name' => $sub_category = fake()->citySuffix(),
            'psc_url' => Str::slug($sub_category, '-'),
            'psc_slug' => uniqid(),
        ];
    }
}
