<?php

namespace App\Internal\Api\v1\Auth\DTOs;

class AuthRegisterDTOs
{
    public string $FullName;
    public int $NomorWhatsapp; //whatsapp number
    public string $Password;

    public function __construct(
        string $FullName,
        int $NomorWhatsapp,
        string $Password,
    ) {
        $this->FullName = $FullName;
        $this->NomorWhatsapp = $NomorWhatsapp;
        $this->Password = $Password;
    }
}
