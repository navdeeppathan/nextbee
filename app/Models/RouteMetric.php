<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteMetric extends Model
{
    protected $table = 'route_metrics';

    protected $primaryKey = 'metric_id';

    public $timestamps = false;

    protected $fillable = [
        'route_id',
        'estimated_duration',
        'actual_duration',
        'efficiency',
        'completion_time'
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}