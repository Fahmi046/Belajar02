<?php

namespace Database\Factories;

use App\Models\GoodsReceipt;
use App\Models\PurchaseOrder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoodsReceiptFactory extends Factory
{
    protected $model = GoodsReceipt::class;

    public function definition(): array
    {
        return [
            'receipt_number' => 'GRN-' . fake()->unique()->randomNumber(6),
            'purchase_order_id' => PurchaseOrder::factory(),
            'receipt_date' => fake()->dateTimeBetween('-6 months', 'now'),
            'notes' => fake()->sentence(),
            'received_by' => User::factory(),
        ];
    }
}