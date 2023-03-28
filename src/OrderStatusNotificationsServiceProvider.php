<?php

declare(strict_types=1);

namespace PetShop\OrderStatusNotifications;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use PetShop\OrderStatusNotifications\Observers\ModelObserver;

class OrderStatusNotificationsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('order-status-notifications')
            ->hasConfigFile();
    }

    public function boot(): void
    {
        $model = config('order-status-notifications.model');

        if (class_exists($model)) {
            $model::observe(ModelObserver::class);
        }
    }
}
