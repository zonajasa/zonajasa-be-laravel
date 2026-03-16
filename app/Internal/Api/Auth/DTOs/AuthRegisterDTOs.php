<?php

namespace App\Internal\Api\Auth\DTOs;

class AuthRegisterDTOs
{
    public string $nama_lengkap;
    public int $no_whatsapp; //email atau wa
    public string $password;

    public function __construct(
        string $nama_lengkap,
        int $no_whatsapp,
        string $password,
    ) {
        $this->nama_lengkap = $nama_lengkap;
        $this->no_whatsapp = $no_whatsapp;
        $this->password = $password;
    }
}
