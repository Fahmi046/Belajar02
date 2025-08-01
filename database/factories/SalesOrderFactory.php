<?php

namespace Database\Factories;

use App\Models\SalesOrder;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesOrderFactory extends Factory
{
    protected $model = SalesOrder::class;

    public function definition(): array
    {
        return [
            // Pastikan baris ini ada dan tidak ada kesalahan ketik!
            'so_number' => 'SO-' . fake()->unique()->randomNumber(6), // HARUS ADA DAN UNIQUE!
            'customer_id' => Customer::factory(),
            'order_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'required_delivery_date' => fake()->dateTimeBetween('now', '+1 month'),
            'status' => fake()->randomElement(['draft', 'confirmed', 'shipped', 'completed', 'canceled']),
            'notes' => fake()->sentence(),
            'created_by' => User::factory(),
        ];
    }
}