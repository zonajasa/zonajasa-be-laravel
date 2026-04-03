<?php

namespace App\Domain\Api\v1\Auth\Entities;

class AuthRegisterEntitiesDomain
{
    private string $WaEncrypted;
    private string $Expire;
    private string $Label;

    public function __construct(string $WaEncrypted, string $Expire, string $Label = 'register_token')
    {
        $this->WaEncrypted = $WaEncrypted;
        $this->Expire = $Expire;
        $this->Label = $Label;
    }

    public function GetWaEncrypted(): string|null
    {
        return $this->WaEncrypted ?? null;
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
