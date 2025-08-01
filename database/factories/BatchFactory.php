<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    protected $model = Batch::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(), // Akan diisi saat seeder
            'batch_number' => fake()->unique()->bothify('B???-###??'),
            'expiry_date' => fake()->dateTimeBetween('+6 months', '+5 years')->format('Y-m-d'),
            'current_stock' => fake()->numberBetween(100, 1000),
            'location' => fake()->randomElement(['Gudang A', 'Gudang B', 'Rak 1', 'Rak 2', 'Zona Dingin']),
        ];
    }
}