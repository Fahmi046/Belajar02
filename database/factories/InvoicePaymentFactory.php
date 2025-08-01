<?php

namespace Database\Factories;

use App\Models\InvoicePayment;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoicePaymentFactory extends Factory
{
    protected $model = InvoicePayment::class;

    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::factory(),
            'payment_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'amount' => fake()->randomFloat(2, 100000, 5000000),
            'payment_method' => fake()->randomElement(['Cash', 'Bank Transfer', 'Giro']),
            'notes' => fake()->sentence(),
            'received_by' => User::factory(),
        ];
    }
}