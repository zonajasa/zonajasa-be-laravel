<?php

namespace App\Infrastructure\Database\v1\Repositories;

use App\Domain\Api\v1\Profile\Repositories\ProfileRepositoriesDomainInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ProfileInfrastructureDatabaseRepositories implements ProfileRepositoriesDomainInterface
{
    //query builder
    public static function Query(string $TableName): Builder
    {
        return DB::table($TableName);
    }
}
