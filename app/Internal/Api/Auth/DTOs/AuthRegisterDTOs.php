<?php

namespace App\Internal\Api\Auth\DTOs;

class AuthRegisterDTOs
{
    public string $nama_lengkap;
    public string $ephone; //email atau wa
    public string $password;

    public function __construct(
        string $nama_lengkap,
        string $ephone,
        string $password,
    ) {
        $this->nama_lengkap = $nama_lengkap;
        $this->ephone = $ephone;
        $this->password = $password;
    }
}
