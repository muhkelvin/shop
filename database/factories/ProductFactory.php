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
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'stock' => $this->faker->numberBetween(1, 100),
            'category_id' => \App\Models\Category::factory(),
            'brand' => $this->faker->company,
            'image' => $this->faker->imageUrl(),
            'discount' => $this->faker->numberBetween(0, 30),
            'variation' => json_encode([
                'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
                'color' => $this->faker->randomElement(['Red', 'Blue', 'Green'])
            ]),
        ];
    }
}
