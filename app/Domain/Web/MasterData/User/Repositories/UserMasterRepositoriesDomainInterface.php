<?php

namespace App\Domain\Web\MasterData\User\Repositories;

use Illuminate\Database\Query\Builder;

interface UserMasterRepositoriesDomainInterface
{
    public static function Query(string $TableName): Builder;
    public function GetAllUser();
}
