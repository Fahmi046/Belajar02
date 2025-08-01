<?php

namespace Database\Factories;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderFactory extends Factory
{
    protected $model = PurchaseOrder::class;

    public function definition(): array
    {
        return [
            'po_number' => 'PO-' . fake()->unique()->randomNumber(6),
            'supplier_id' => Supplier::factory(),
            'order_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'expected_delivery_date' => fake()->dateTimeBetween('now', '+1 month'),
            'status' => fake()->randomElement(['draft', 'ordered', 'received', 'canceled']),
            'notes' => fake()->sentence(),
            'created_by' => User::factory(),
        ];
    }
}