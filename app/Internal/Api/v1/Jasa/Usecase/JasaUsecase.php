<?php

namespace App\Internal\Api\v1\Jasa\Usecase;

use App\Domain\Api\v1\Jasa\Services\JasaServicesDomain;

class JasaUsecase
{
    public function __construct(
        private JasaServicesDomain $service
    ) {}
}
