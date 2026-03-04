<?php

namespace App\Providers;

use App\Domain\Api\Auth\Repositories\AuthRepositoriesDomainInterface;
use App\Infrastructure\Database\Repositories\AuthInfrastructureDatabaseRepositories;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoriesDomainInterface::class, AuthInfrastructureDatabaseRepositories::class); //register repositories auth;

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
