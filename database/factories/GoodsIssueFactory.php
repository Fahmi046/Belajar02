<?php

namespace Database\Factories;

use App\Models\GoodsIssue;
use App\Models\SalesOrder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoodsIssueFactory extends Factory
{
    protected $model = GoodsIssue::class;

    public function definition(): array
    {
        return [
            'issue_number' => 'GIN-' . fake()->unique()->randomNumber(6),
            'sales_order_id' => SalesOrder::factory(),
            'issue_date' => fake()->dateTimeBetween('-6 months', 'now'),
            'notes' => fake()->sentence(),
            'issued_by' => User::factory(),
        ];
    }
}