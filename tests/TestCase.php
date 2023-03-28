<?php

namespace PetShop\PetShopOrderStatusNotifications\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use PetShop\PetShopOrderStatusNotifications\PetShopOrderStatusNotificationsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'PetShop\\PetShopOrderStatusNotifications\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            PetShopOrderStatusNotificationsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_pet-shop-order-status-notifications_table.php.stub';
        $migration->up();
        */
    }
}
