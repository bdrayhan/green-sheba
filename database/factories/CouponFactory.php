<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'coupon_name' => $name = Str::upper(fake()->unique()->word),
            'coupon_discount' => fake()->numberBetween(100, 500),
            'coupon_creator' => 1,
            'coupon_active' => 1,
            'coupon_slug' => Str::slug($name, '-'),
            // 'coupon_code' => fake()->unique()->word,
            // 'coupon_validity' => fake()->dateTimeBetween('+1 week', '+1 month'),
        ];
    }
}
