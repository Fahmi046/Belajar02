<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'batch_number',
        'expiry_date',
        'current_stock',
        'location',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    /**
     * Get the product that owns the batch.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the goods receipt items for the batch.
     */
    public function goodsReceiptItems(): HasMany
    {
        return $this->hasMany(GoodsReceiptItem::class);
    }

    /**
     * Get the goods issue items for the batch.
     */
    public function goodsIssueItems(): HasMany
    {
        return $this->hasMany(GoodsIssueItem::class);
    }
}