<?php

namespace Database\Factories;

use App\Models\SalesOrderItem;
use App\Models\SalesOrder;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesOrderItemFactory extends Factory
{
    protected $model = SalesOrderItem::class;

    public function definition(): array
    {
        return [
            'sales_order_id' => SalesOrder::factory(),
            'product_id' => Product::factory(),
            'quantity' => fake()->numberBetween(1, 50),
            'unit_price' => fake()->randomFloat(2, 10000, 500000),
            'discount_percentage' => fake()->randomElement([0, 5, 10, 15]),
        ];
    }
}