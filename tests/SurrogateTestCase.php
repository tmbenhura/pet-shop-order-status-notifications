<?php

declare(strict_types=1);

namespace PetShop\OrderStatusNotifications\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Illuminate\Database\Eloquent\Factories\Factory;
use PetShop\OrderStatusNotifications\OrderStatusNotificationsServiceProvider;
use PetShop\OrderStatusNotifications\Tests\Models\Order;
use PetShop\OrderStatusNotifications\Tests\Models\OrderStatus;
use PetShop\OrderStatusNotifications\Tests\Models\Payment;
use PetShop\OrderStatusNotifications\Tests\Models\User;
use Illuminate\Support\Str;

class SurrogateTestCase extends Orchestra
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
        config()->set('order-status-notifications.model', Order::class);

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

    public function createOrderStatus(): OrderStatus
    {
        OrderStatus::unguard();

        $orderStatus = OrderStatus::create(
            [
                'uuid' => Str::uuid()->toString(),
                'title' => fake()->name(),
            ]
        );

        OrderStatus::reguard();

        return $orderStatus;
    }

    public function createOrder(): Order
    {
        User::unguard();

        $user = User::create(
            [
                'uuid' => Str::uuid()->toString(),
                'first_name' => fake()->name(),
                'last_name' => fake()->lastName(),
                'is_admin' => fake()->boolean(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'address' => fake()->streetAddress(),
                'phone_number' => fake()->phoneNumber(),
                'is_marketing' => fake()->boolean(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'last_login_at' => now(),
            ]
        );

        User::reguard();

        Payment::unguard();

        $payment = Payment::create(
            [
                'uuid' => Str::uuid()->toString(),
                'type' => fake()->text(50),
                'details' => json_encode(
                    [
                        "holder_name" => "string",
                        "number" => "string",
                        "ccv" => "int",
                        "expire_date" => "string",
                    ]
                ),
            ]
        );

        Payment::reguard();

        $orderStatus = $this->createOrderStatus();

        Order::unguard();

        $order = Order::create(
            [
                'user_id' => $user->id,
                'uuid' => Str::uuid()->toString(),
                'order_status_uuid' => $orderStatus->uuid,
                'payment_uuid' => $payment->uuid,
                'billing_address' => fake()->streetAddress(),
                'shipping_address' => fake()->streetAddress(),
                'delivery_fee_cents' => 1500,
                'amount_cents' => 100,
                'shipped_at' => now(),
            ]
        );

        Order::reguard();

        return $order;
    }
}
