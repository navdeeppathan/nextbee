<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    protected $fillable = [
        'order_id',
        'order_item_id',
        'user_id',
        'action_type',
        'old_value',
        'new_value'
    ];
}