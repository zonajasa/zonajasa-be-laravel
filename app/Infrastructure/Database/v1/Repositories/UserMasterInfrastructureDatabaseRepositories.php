<?php

namespace App\Infrastructure\Database\v1\Repositories;

use App\Domain\Web\MasterData\User\Repositories\UserMasterRepositoriesDomainInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class UserMasterInfrastructureDatabaseRepositories implements UserMasterRepositoriesDomainInterface
{
    //query builder
    public static function Query(string $TableName): Builder
    {
        return DB::table($TableName);
    }

    public function GetAllUser()
    {
        return $this->Query('users');
    }
}
