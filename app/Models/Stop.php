<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    protected $table = 'stops';

    protected $primaryKey = 'stop_id';

    protected $fillable = [
        'route_id',
        'customer_name',
        'address',
        'status',
        'delivery_time',
        'sequence_order'
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}