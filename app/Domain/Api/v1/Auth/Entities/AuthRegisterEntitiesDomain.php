<?php

namespace App\Domain\Api\v1\Auth\Entities;

class AuthRegisterEntitiesDomain
{
    private string $KodeUser;
    private string $Expire;
    private string $Label;

    public function __construct(string $KodeUser, string $Expire, string $Label = 'register_token')
    {
        $this->KodeUser = $KodeUser;
        $this->Expire = $Expire;
        $this->Label = $Label;
    }

    public function GetKodeUser(): string|null
    {
        return $this->KodeUser ?? null;
    }

    public function GetExpire(): string|null
    {
        return $this->Expire ?? null;
    }

    public function GetLabel(): string|null
    {
        return $this->Label ?? null;
    }
}
