<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ ADD THIS
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'business_name',
        'phone',
        'licence_no',
        'licence_expiry',
        'assigned_vehicle',
        'business_type',
        'delivery_address',
        'primary_contact_name',
        'preferred_delivery_days',
        'monthly_volume',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'preferred_delivery_days' => 'array',
    ];



    public function routes()
    {
        return $this->hasMany(Route::class, 'driver_id');
    }
}