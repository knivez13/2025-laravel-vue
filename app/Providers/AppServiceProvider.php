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
            \App\Http\Controllers\Api\Maintenance\Amenity\AmenityInterface::class                           => \App\Http\Controllers\Api\Maintenance\Amenity\AmenityRepository::class,
            \App\Http\Controllers\Api\Maintenance\Appliances\AppliancesInterface::class                     => \App\Http\Controllers\Api\Maintenance\Appliances\AppliancesRepository::class,
            \App\Http\Controllers\Api\Maintenance\FileType\FileTypeInterface::class                         => \App\Http\Controllers\Api\Maintenance\FileType\FileTypeRepository::class,
            \App\Http\Controllers\Api\Maintenance\ModePayment\ModePaymentInterface::class                   => \App\Http\Controllers\Api\Maintenance\ModePayment\ModePaymentRepository::class,
            \App\Http\Controllers\Api\Maintenance\PriceType\PriceTypeInterface::class                       => \App\Http\Controllers\Api\Maintenance\PriceType\PriceTypeRepository::class,
            \App\Http\Controllers\Api\Maintenance\PropCategory\PropCategoryInterface::class                 => \App\Http\Controllers\Api\Maintenance\PropCategory\PropCategoryRepository::class,
            \App\Http\Controllers\Api\Maintenance\PropCondition\PropConditionInterface::class               => \App\Http\Controllers\Api\Maintenance\PropCondition\PropConditionRepository::class,
            \App\Http\Controllers\Api\Maintenance\PropListType\PropListTypeInterface::class                 => \App\Http\Controllers\Api\Maintenance\PropListType\PropListTypeRepository::class,
            \App\Http\Controllers\Api\Maintenance\PropStatus\PropStatusInterface::class                     => \App\Http\Controllers\Api\Maintenance\PropStatus\PropStatusRepository::class,
            \App\Http\Controllers\Api\Maintenance\PropType\PropTypeInterface::class                         => \App\Http\Controllers\Api\Maintenance\PropType\PropTypeRepository::class,
            \App\Http\Controllers\Api\Maintenance\Utility\UtilityInterface::class                           => \App\Http\Controllers\Api\Maintenance\Utility\UtilityRepository::class,
            \App\Http\Controllers\Api\Maintenance\NearLocationFilter\NearLocationFilterInterface::class     => \App\Http\Controllers\Api\Maintenance\NearLocationFilter\NearLocationFilterRepository::class,

            \App\Http\Controllers\Api\Subscription\SubscriptionType\SubscriptionTypeInterface::class        => \App\Http\Controllers\Api\Subscription\SubscriptionType\SubscriptionTypeRepository::class,
            \App\Http\Controllers\Api\Subscription\UserSubscription\UserSubscriptionInterface::class        => \App\Http\Controllers\Api\Subscription\UserSubscription\UserSubscriptionRepository::class,

            \App\Http\Controllers\Api\Property\Favorites\FavoritesInterface::class                          => \App\Http\Controllers\Api\Property\Favorites\FavoritesRepository::class,
            \App\Http\Controllers\Api\Property\PropertyList\PropertyListInterface::class                    => \App\Http\Controllers\Api\Property\PropertyList\PropertyListRepository::class,
            \App\Http\Controllers\Api\Property\SaveProperty\SavePropertyInterface::class                    => \App\Http\Controllers\Api\Property\SaveProperty\SavePropertyRepository::class,

            \App\Http\Controllers\Api\User\Role\RoleInterface::class                                        => \App\Http\Controllers\Api\User\Role\RoleRepository::class,
            \App\Http\Controllers\Api\User\UserList\UserListInterface::class                                => \App\Http\Controllers\Api\User\UserList\UserListRepository::class,
            \App\Http\Controllers\Api\PaymentGateway\Paymongo\PaymongoInterface::class                      => \App\Http\Controllers\Api\PaymentGateway\Paymongo\PaymongoRepository::class,

            \App\Http\Controllers\Api\Chat\PropertyChat\PropertyChatInterface::class                        => \App\Http\Controllers\Api\Chat\PropertyChat\PropertyChatRepository::class,
            \App\Http\Controllers\Api\Chat\PropertyMessage\PropertyMessageInterface::class                  => \App\Http\Controllers\Api\Chat\PropertyMessage\PropertyMessageRepository::class,

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
