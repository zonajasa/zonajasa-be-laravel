<?php

namespace App\Internal\Api\Auth\DTOs;

class AuthLoginDTOs
{
    public string $ephone;
    public string $password;

    public function __construct(string $ephone, string $password)
    {
        $this->ephone = $ephone;
        $this->password = $password;
    }
}
