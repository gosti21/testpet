<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            //'sku' => $this->faker->unique()->numberBetween(100000,10000),
            //'name' => $this->faker->words(3),
            //'description' => $this->faker->text(),
            //'image_path' => 'products/' . $this->faker->image('public/storage/products', 640, 480, null, false),
            //'price' => $this->faker->randomFloat(2, 1, 1000),
            //'subcategory_id' =>$this->faker->numberBetween(1, 632),
        ];
    }
}
