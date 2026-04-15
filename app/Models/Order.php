<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\User;
class Order extends Model
{
    use HasFactory;

    // 🔥 ADD THIS
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'discount',
        'delivery_instructions',   // ✅ ADD THIS
        'internal_notes',         // ✅ ADD THIS
        'payment_status',
        'parent_order_id',   // 🔥 ADD THIS
        'is_active'          // 🔥 ADD THIS

    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);

    }

}