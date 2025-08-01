<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'so_number',
        'customer_id',
        'order_date',
        'required_delivery_date',
        'status',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'order_date' => 'date',
        'required_delivery_date' => 'date',
    ];

    /**
     * Get the customer that owns the sales order.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the user who created the sales order.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the items for the sales order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    /**
     * Get the goods issues for the sales order.
     */
    public function goodsIssues(): HasMany
    {
        return $this->hasMany(GoodsIssue::class);
    }

    /**
     * Get the invoice for the sales order.
     */
    public function invoice(): HasMany
    {
        return $this->hasMany(Invoice::class); // One-to-one or one-to-many depending on business logic
    }
}