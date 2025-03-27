<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $maintenanceBindings = [
            \App\Repositories\BaseRepositoryInterface::class                                                => \App\Repositories\BaseRepository::class,
            \App\Http\Controllers\Api\Auth\AuthInterface::class                                             => \App\Http\Controllers\Api\Auth\AuthRepository::class,
        ];

        foreach ($maintenanceBindings as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
