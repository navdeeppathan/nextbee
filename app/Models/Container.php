<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $fillable = [
        'container_no',
        'eta_days',
        'arrival_date',
        'status'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'container_products');
    }
}
