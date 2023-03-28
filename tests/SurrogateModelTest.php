<?php

declare(strict_types=1);

use PetShop\OrderStatusNotifications\Tests\Models\User;
use PetShop\OrderStatusNotifications\Tests\Models\Order;
use PetShop\OrderStatusNotifications\Tests\Models\Payment;
use PetShop\OrderStatusNotifications\Tests\Models\OrderStatus;

test('package has surrogate models for testing', function () {
    User::unguard();
    Payment::unguard();
    OrderStatus::unguard();
    Order::unguard();

    $user = User::create(
        [
            'uuid' => Str::uuid(),
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

    $payment = Payment::create(
        [
            'uuid' => Str::uuid(),
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

    $orderStatus = OrderStatus::create(
        [
            'uuid' => Str::uuid(),
            'title' => fake()->name(),
        ]
    );

    $order = Order::create(
        [
            'user_id' => $user->id,
            'uuid' => Str::uuid(),
            'order_status_uuid' => $orderStatus->uuid,
            'payment_uuid' => $payment->uuid,
            'billing_address' => fake()->streetAddress(),
            'shipping_address' => fake()->streetAddress(),
            'delivery_fee_cents' => 1500,
            'amount_cents' => 100,
            'shipped_at' => now(),
        ]
    );

    expect($user)->id->toBe(1);
    expect($payment)->id->toBe(1);
    expect($orderStatus)->id->toBe(1);
    expect($order)->id->toBe(1);
});
