<?php

namespace App\Domain\Api\v1\Jasa\Services;

use App\Domain\Api\v1\Jasa\Repositories\JasaRepositoriesDomainInterface;

class JasaServicesDomain
{
    public function __construct(
        private JasaRepositoriesDomainInterface $repository
    ) {}
}
