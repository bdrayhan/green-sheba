<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bc_id' => rand(1, 10),
            'tag_id' => Tag::all()->random()->id,
            'post_title' => $post_title = fake()->sentence($nbWords = 6, $variableNbWords = true),
            'post_url' => Str::slug($post_title, '-'),
            'post_short_details' => fake()->sentence($nbWords = 10, $variableNbWords = true),
            'post_details' => fake()->paragraph($nbSentences = 10, $variableNbSentences = true),
            'post_feature_image' => fake()->imageUrl($width = 1200, $height = 520, 'cats', true, 'Faker', true),
            'post_slug' => uniqid(),
            'post_active' => 1,
            'blog_meta_title' => Str::lower($post_title),
            'blog_meta_details' => fake()->sentence($nbWords = 10, $variableNbWords = true),

        ];
    }
}
