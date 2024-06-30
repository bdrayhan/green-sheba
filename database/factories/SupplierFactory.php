<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'supplier_name' => fake()->name,
            'supplier_phone' => fake()->phoneNumber,
            'supplier_email' => fake()->unique()->safeEmail,
            'wireHouse_address' => fake()->address,
            'supplier_slug' => uniqid(),
        ];
    }
}
