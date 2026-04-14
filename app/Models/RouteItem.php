<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteItem extends Model
{
    protected $table = 'route_items';

    protected $primaryKey = 'item_id';

    public $timestamps = false;

    protected $fillable = [
        'route_id',
        'total_items',
        'loaded_items',
        'delivered_items',
        'returns'
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}