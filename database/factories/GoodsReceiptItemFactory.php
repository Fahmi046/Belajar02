<?php

namespace Database\Factories;

use App\Models\GoodsReceiptItem;
use App\Models\GoodsReceipt;
use App\Models\Product;
use App\Models\Batch;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoodsReceiptItemFactory extends Factory
{
    protected $model = GoodsReceiptItem::class;

    public function definition(): array
    {
        return [
            'goods_receipt_id' => GoodsReceipt::factory(),
            'product_id' => Product::factory(), // Akan diisi saat seeder
            'batch_id' => null, // Akan diisi saat seeder jika batch sudah ada
            'batch_number_received' => fake()->bothify('B???-###??'),
            'expiry_date_received' => fake()->dateTimeBetween('+6 months', '+5 years')->format('Y-m-d'),
            'quantity_received' => fake()->numberBetween(10, 500),
            'unit_price_at_receipt' => fake()->randomFloat(2, 5000, 200000),
        ];
    }
}