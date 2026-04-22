<?php

namespace App\Providers;

use App\Domain\Api\v1\Auth\Repositories\AuthRepositoriesDomainInterface;
use App\Domain\Api\v1\Jasa\Repositories\JasaRepositoriesDomainInterface;
use App\Domain\Api\v1\Profile\Repositories\ProfileRepositoriesDomainInterface;
use App\Infrastructure\Database\v1\Repositories\AuthInfrastructureDatabaseRepositories;
use App\Infrastructure\Database\v1\Repositories\JasaInfrastructureDatabaseRepositories;
use App\Infrastructure\Database\v1\Repositories\ProfileInfrastructureDatabaseRepositories;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoriesDomainInterface::class, AuthInfrastructureDatabaseRepositories::class); //register repositories auth;
        $this->app->bind(JasaRepositoriesDomainInterface::class, JasaInfrastructureDatabaseRepositories::class); //jasa;
        $this->app->bind(ProfileRepositoriesDomainInterface::class, ProfileInfrastructureDatabaseRepositories::class); //profile;

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::tokensExpireIn(now()->addHour());
        Passport::refreshTokensExpireIn(now()->addHour());
        Passport::personalAccessTokensExpireIn(now()->addHour());
    }
}
