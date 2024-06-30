<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<BlogCategory>
 */
class BlogCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bc_name' => $bc_name = fake()->unique()->state(),
            'bc_remark' => fake()->sentence($nbWords = 4, $variableNbWords = true),
            'bc_url' => Str::slug($bc_name, '-'),
            'bc_slug' => uniqid('', true),
        ];
    }
}
