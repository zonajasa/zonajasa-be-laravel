<?php

namespace App\Internal\Api\v1\Jasa\Handler;

use App\Internal\Api\v1\Jasa\Constant\JasaConstant;
use App\Internal\Api\v1\Jasa\Usecase\JasaUsecase;

class JasaHandler extends JasaConstant
{
    public function __construct(
        private JasaUsecase $usecase
    ) {}
}
