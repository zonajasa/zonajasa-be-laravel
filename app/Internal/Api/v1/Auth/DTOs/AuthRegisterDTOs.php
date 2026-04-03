<?php

namespace App\Internal\Api\v1\Auth\DTOs;

class AuthRegisterDTOs
{
    public string $NamaLengkap;
    public int $NoWhatsapp; //email atau wa
    public string $Password;

    public function __construct(
        string $NamaLengkap,
        int $NoWhatsapp,
        string $Password,
    ) {
        $this->NamaLengkap = $NamaLengkap;
        $this->NoWhatsapp = $NoWhatsapp;
        $this->Password = $Password;
    }
}
