<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GoodsIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_number',
        'sales_order_id',
        'issue_date',
        'notes',
        'issued_by',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    /**
     * Get the sales order that corresponds to the goods issue.
     */
    public function salesOrder(): BelongsTo
    {
        return $this->belongsTo(SalesOrder::class);
    }

    /**
     * Get the user who issued the goods.
     */
    public function issuer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    /**
     * Get the items for the goods issue.
     */
    public function items(): HasMany
    {
        return $this->hasMany(GoodsIssueItem::class);
    }
}