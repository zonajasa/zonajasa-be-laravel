<?php

namespace App\Internal\Api\v1\Auth\DTOs;

class AuthLoginDTOs
{
    public int $no_whatsapp;
    public string $password;

    public function __construct(int $no_whatsapp, string $password)
    {
        $this->no_whatsapp = $no_whatsapp;
        $this->password = $password;
    }
}
