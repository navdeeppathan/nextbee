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
        'phone'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}