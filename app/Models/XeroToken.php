<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XeroToken extends Model
{
    protected $fillable = [
        'user_id',
        'access_token',
        'refresh_token',
        'tenant_id',
        'expires_at'
    ];
}