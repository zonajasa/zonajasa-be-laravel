<?php

namespace App\Internal\Api\v1\Auth\DTOs;

class AuthRegisterDTOs
{
    public string $NamaLengkap;
    public int $NomorWhatsapp; //whatsapp number
    public string $Password;

    public function __construct(
        string $NamaLengkap,
        int $NomorWhatsapp,
        string $Password,
    ) {
        $this->NamaLengkap = $NamaLengkap;
        $this->NomorWhatsapp = $NomorWhatsapp;
        $this->Password = $Password;
    }
}
