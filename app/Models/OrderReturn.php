<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderReturn extends Model
{
    protected $table = 'order_returns';

    protected $fillable = [
        'order_id',
        'product_id',
        'user_id',
        'return_number',
        'status',
        'refund_amount',
        'refund_status',
        'reason',
        'notes',
        'quantity'
    ];

    protected $casts = [
        'refund_amount' => 'decimal:2',
    ];

    /**
     * Relationships
     */

    // Return belongs to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Return belongs to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Return belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}