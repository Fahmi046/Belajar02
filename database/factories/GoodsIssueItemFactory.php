<?php

namespace Database\Factories;

use App\Models\GoodsIssueItem;
use App\Models\GoodsIssue;
use App\Models\Product;
use App\Models\Batch;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoodsIssueItemFactory extends Factory
{
    protected $model = GoodsIssueItem::class;

    public function definition(): array
    {
        return [
            'goods_issue_id' => GoodsIssue::factory(),
            'product_id' => Product::factory(), // Akan diisi saat seeder
            'batch_id' => Batch::factory(), // Akan diisi saat seeder
            'quantity_issued' => fake()->numberBetween(1, 50),
        ];
    }
}