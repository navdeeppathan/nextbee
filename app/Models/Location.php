<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = [
        'product_id',
        'shelf_life',
        'aisle',
        'rack',
        'basket',
        'quantity',
    ];

    protected $casts = [
        'shelf_life' => 'integer',
        'rack' => 'integer',
        'basket' => 'integer',
        'quantity' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}