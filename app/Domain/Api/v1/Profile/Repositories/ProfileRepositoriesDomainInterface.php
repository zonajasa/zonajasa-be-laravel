<?php

namespace App\Domain\Api\v1\Profile\Repositories;

use Illuminate\Database\Query\Builder;

interface ProfileRepositoriesDomainInterface
{
    //query builder
    public static function Query(string $TableName): Builder;
}
