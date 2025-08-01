<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\SalesOrder;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            'invoice_number' => 'INV-' . fake()->unique()->randomNumber(6),
            'sales_order_id' => SalesOrder::factory(),
            'customer_id' => Customer::factory(),
            'invoice_date' => fake()->dateTimeBetween('-6 months', 'now'),
            'due_date' => fake()->dateTimeBetween('now', '+1 month'),
            'total_amount' => fake()->randomFloat(2, 500000, 50000000),
            'status' => fake()->randomElement(['unpaid', 'paid', 'partially_paid']),
            'created_by' => User::factory(),
        ];
    }
}