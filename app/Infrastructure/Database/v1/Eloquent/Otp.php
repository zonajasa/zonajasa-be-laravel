<?php

namespace App\Infrastructure\Database\v1\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [
        'kode_user',
        'otp',
        'expired_at',
        'created_at'
    ];
    protected $casts = [
        'created_at' => 'datetime'
    ];
}
