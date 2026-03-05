<?php

namespace App\Infrastructure\Database\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = ['code', 'no_whatsapp', 'email', 'expired_at', 'created_at'];
    protected $casts = ['created_at' => 'datetime'];
}
