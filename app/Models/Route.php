<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = 'routes';

    protected $primaryKey = 'route_id';

    protected $fillable = [
        'route_code',
        'route_name',
        'area',
        'driver_id',
        'van_number',
        'status',
        'total_stops',
        'completed_stops',
        'start_time',
        'end_time'
    ];

    // 🔥 Driver (User)
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    // 🔥 Stops
    public function stops()
    {
        return $this->hasMany(Stop::class, 'route_id');
    }

    // 🔥 Items
    public function items()
    {
        return $this->hasOne(RouteItem::class, 'route_id');
    }

    // 🔥 Metrics
    public function metrics()
    {
        return $this->hasOne(RouteMetric::class, 'route_id');
    }
}