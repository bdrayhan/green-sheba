<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'banner_title' => $title = fake()->unique()->sentence(2),
            'banner_mid_title' => fake()->unique()->sentence(2),
            'banner_sub_title' => fake()->unique()->sentence(3),
            'banner_button' => 'Shop Now',
            'banner_publish' => 1,
            'banner_url' => Str::slug($title, '-'),
            'banner_image' => '/frontend/assets/images/banners/01.png',
            // 'banner_image' => fake()->imageUrl(1920, 680, 'Slider', true),
            'banner_slug' => uniqid(),
        ];
    }
}
