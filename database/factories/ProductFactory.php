<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            // Pastikan baris ini ada dan tidak ada kesalahan ketik!
            'name' => fake()->word() . ' ' . fake()->randomElement(['Tablet', 'Sirup', 'Kapsul', 'Injeksi']) . ' ' . fake()->numberBetween(100, 1000) . 'mg',
            'sku' => 'SKU-' . fake()->unique()->randomNumber(5),
            'brand' => fake()->company(),
            'formulation' => fake()->randomElement(['Tablet', 'Sirup', 'Kapsul', 'Injeksi', 'Salep']),
            'strength' => fake()->numberBetween(100, 1000) . 'mg',
            'hna' => fake()->randomFloat(2, 10000, 500000),
            'sell_price' => fake()->randomFloat(2, 10000, 600000), // Diperbaiki sedikit agar tidak selalu HNA*faktor
            'unit' => fake()->randomElement(['Box', 'Strip', 'Botol', 'Pcs']),
            'min_stock_level' => fake()->numberBetween(5, 50),
            'is_active' => fake()->boolean(90),
        ];
    }
}