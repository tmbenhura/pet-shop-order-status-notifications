<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Event;
use PetShop\OrderStatusNotifications\Events\OrderStatusUpdated;

test('package broadcasts event when model updated', function () {
    Event::fake(OrderStatusUpdated::class);

    $order = $this->createOrder();
    $order->forceFill(
        ['order_status_uuid' => $this->createOrderStatus()->uuid]
    )->update();
    expect('')->toBe('');
    Event::assertDispatched(OrderStatusUpdated::class);
});
