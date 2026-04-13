<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
  // app/Models/Coupon.php
protected $fillable = [
    'code',
    'type',
    'value',
    'min_amount',
    'expires_at',
    'status'
];
}