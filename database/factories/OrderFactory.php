<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'total_price' => $this->faker->randomFloat(2, 50, 1000),
            'shipping_address' => $this->faker->address,
            'payment_method' => $this->faker->randomElement(['credit_card', 'e_wallet', 'bank_transfer']),
            'order_status' => $this->faker->randomElement(['pending', 'confirmed', 'shipped', 'delivered', 'cancelled']),
            'tracking_number' => $this->faker->numerify('TRK###'),
        ];
    }
}
