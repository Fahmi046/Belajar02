<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoodsReceiptItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'goods_receipt_id',
        'product_id',
        'batch_id', // Ini akan diisi jika batch sudah ada
        'batch_number_received',
        'expiry_date_received',
        'quantity_received',
        'unit_price_at_receipt',
    ];

    protected $casts = [
        'expiry_date_received' => 'date',
    ];

    /**
     * Get the goods receipt that owns the item.
     */
    public function goodsReceipt(): BelongsTo
    {
        return $this->belongsTo(GoodsReceipt::class);
    }

    /**
     * Get the product that owns the item.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the batch associated with this receipt item (if it's an existing batch).
     */
    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }
}