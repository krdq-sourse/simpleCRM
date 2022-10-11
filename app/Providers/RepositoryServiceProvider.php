<?php

namespace App\Providers;

use App\Repositories\CompanyRepository;
use App\Repositories\Interfaces\CompanyRepositoryInterfaces;
use App\Repositories\Interfaces\UserRepositoryInterfaces;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CompanyRepositoryInterfaces::class,
            CompanyRepository::class
        );
        $this->app->bind(
            UserRepositoryInterfaces::class,
            UserRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
