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

            \App\Http\Controllers\Api\Maintenance\AgentGameCommission\AgentGameCommissionInterface::class           => \App\Http\Controllers\Api\Maintenance\AgentGameCommission\AgentGameCommissionRepository::class,
            \App\Http\Controllers\Api\Maintenance\AgentType\AgentTypeInterface::class                               => \App\Http\Controllers\Api\Maintenance\AgentType\AgentTypeRepository::class,
            \App\Http\Controllers\Api\Maintenance\BankType\BankTypeInterface::class                                 => \App\Http\Controllers\Api\Maintenance\BankType\BankTypeRepository::class,
            \App\Http\Controllers\Api\Maintenance\GamePresent\GamePresentInterface::class                           => \App\Http\Controllers\Api\Maintenance\GamePresent\GamePresentRepository::class,
            \App\Http\Controllers\Api\Maintenance\GamePresentAnnouncement\GamePresentAnnouncementInterface::class   => \App\Http\Controllers\Api\Maintenance\GamePresentAnnouncement\GamePresentAnnouncementRepository::class,
            \App\Http\Controllers\Api\Maintenance\GamePresentOption\GamePresentOptionInterface::class               => \App\Http\Controllers\Api\Maintenance\GamePresentOption\GamePresentOptionRepository::class,
            \App\Http\Controllers\Api\Maintenance\GameProvider\GameProviderInterface::class                         => \App\Http\Controllers\Api\Maintenance\GameProvider\GameProviderRepository::class,
            \App\Http\Controllers\Api\Maintenance\GameType\GameTypeInterface::class                                 => \App\Http\Controllers\Api\Maintenance\GameType\GameTypeRepository::class,
            \App\Http\Controllers\Api\Maintenance\LiveVideo\LiveVideoInterface::class                               => \App\Http\Controllers\Api\Maintenance\LiveVideo\LiveVideoRepository::class,
            \App\Http\Controllers\Api\Maintenance\VideoType\VideoTypeInterface::class                               => \App\Http\Controllers\Api\Maintenance\VideoType\VideoTypeRepository::class,


            \App\Http\Controllers\Api\GameModerator\GameList\GameListInterface::class                               => \App\Http\Controllers\Api\GameModerator\GameList\GameListRepository::class,

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
