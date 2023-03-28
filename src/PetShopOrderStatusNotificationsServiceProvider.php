<?php

namespace PetShop\PetShopOrderStatusNotifications;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use PetShop\PetShopOrderStatusNotifications\Commands\PetShopOrderStatusNotificationsCommand;

class PetShopOrderStatusNotificationsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('pet-shop-order-status-notifications')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_pet-shop-order-status-notifications_table')
            ->hasCommand(PetShopOrderStatusNotificationsCommand::class);
    }
}
