<?php

namespace App\Infrastructure\Database\v1\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description', 'expired_at', 'created_at'];
    protected $casts = ['created_at' => 'datetime'];
}
