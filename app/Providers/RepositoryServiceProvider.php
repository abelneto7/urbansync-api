<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Filters\Contracts\GenericFilterInterface;
use App\Filters\GenericFilter;
use App\Repositories\Contracts\InterdicaoRepositoryInterface;
use App\Repositories\InterdicaoRepository;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\PermissionRepository;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use App\Repositories\ProfileRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\Contracts\AuthServiceInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(GenericFilterInterface::class, GenericFilter::class);
        $this->app->bind(InterdicaoRepositoryInterface::class, InterdicaoRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
