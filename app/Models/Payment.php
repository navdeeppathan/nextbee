<?php

namespace App\Models;
use App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'amount',
        'method',
        'status'
    ];

     public function order()
    {
        return $this->belongsTo(Order::class);
    }
}