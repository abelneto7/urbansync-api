<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Filters\Contracts\GenericFilterInterface;
use App\Filters\GenericFilter;
use App\Repositories\Contracts\InterdicaoRepositoryInterface;
use App\Repositories\InterdicaoRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(GenericFilterInterface::class, GenericFilter::class);
        $this->app->bind(InterdicaoRepositoryInterface::class, InterdicaoRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
