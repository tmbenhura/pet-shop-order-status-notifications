<?php

declare(strict_types=1);

namespace PetShop\OrderStatusNotifications\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Illuminate\Database\Eloquent\Factories\Factory;
use PetShop\OrderStatusNotifications\OrderStatusNotificationsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'PetShop\\OrderStatusNotifications\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            OrderStatusNotificationsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        foreach ([
            '2014_10_12_000000_create_users_table.php',
            '2023_03_28_141045_create_order_statuses_table.php',
            '2023_03_28_144209_create_payments_table.php',
            '2023_03_28_145419_create_orders_table.php',
        ] as $migrationFile) {
            $migration = include __DIR__."/migrations/$migrationFile";
            $migration->up();
        }
    }
}
