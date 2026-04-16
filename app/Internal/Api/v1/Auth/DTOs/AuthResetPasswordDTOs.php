<?php

namespace App\Internal\Api\v1\Auth\DTOs;

class AuthResetPasswordDTOs
{
    public string $Kode_user;
    public string $Password; //password
    public string $Password_confirmation; //password confirmation

    public function __construct(
        string $Kode_user,
        string $Password,
        string $Password_confirmation
    ) {
        $this->Kode_user = $Kode_user;
        $this->Password = $Password;
        $this->Password_confirmation = $Password_confirmation;
    }
}
