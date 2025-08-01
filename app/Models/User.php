<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tambahkan 'role'
        'phone_number', // Tambahkan 'phone_number'
        'address', // Tambahkan 'address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the purchase orders created by the user.
     */
    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class, 'created_by');
    }

    /**
     * Get the goods receipts received by the user.
     */
    public function goodsReceipts(): HasMany
    {
        return $this->hasMany(GoodsReceipt::class, 'received_by');
    }

    /**
     * Get the sales orders created by the user.
     */
    public function salesOrders(): HasMany
    {
        return $this->hasMany(SalesOrder::class, 'created_by');
    }

    /**
     * Get the goods issues issued by the user.
     */
    public function goodsIssues(): HasMany
    {
        return $this->hasMany(GoodsIssue::class, 'issued_by');
    }

    /**
     * Get the invoices created by the user.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'created_by');
    }

    /**
     * Get the invoice payments received by the user.
     */
    public function invoicePayments(): HasMany
    {
        return $this->hasMany(InvoicePayment::class, 'received_by');
    }
}