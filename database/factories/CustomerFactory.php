<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' ' . fake()->randomElement(['Apotek', 'RS', 'Klinik']), // Pastikan baris ini ada!
            'customer_type' => fake()->randomElement(['Apotek', 'Rumah Sakit', 'Klinik']),
            'contact_person' => fake()->name(),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
        ];
    }
}