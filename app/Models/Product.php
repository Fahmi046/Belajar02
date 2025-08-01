<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'brand',
        'formulation',
        'strength',
        'hna',
        'sell_price',
        'unit',
        'min_stock_level',
        'is_active',
    ];

    /**
     * Get the batches for the product.
     */
    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class);
    }

    /**
     * Get the purchase order items for the product.
     */
    public function purchaseOrderItems(): HasMany
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    /**
     * Get the goods receipt items for the product.
     */
    public function goodsReceiptItems(): HasMany
    {
        return $this->hasMany(GoodsReceiptItem::class);
    }

    /**
     * Get the sales order items for the product.
     */
    public function salesOrderItems(): HasMany
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    /**
     * Get the goods issue items for the product.
     */
    public function goodsIssueItems(): HasMany
    {
        return $this->hasMany(GoodsIssueItem::class);
    }
}