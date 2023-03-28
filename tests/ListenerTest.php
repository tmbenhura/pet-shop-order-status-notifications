<?php

declare(strict_types=1);

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Event;
use PetShop\OrderStatusNotifications\Events\OrderStatusUpdated;
use PetShop\OrderStatusNotifications\Listeners\OnOrderStatusUpdatedCallWebhook;

test('package broadcasts event when model updated', function () {
    Event::fake(OrderStatusUpdated::class);

    $order = $this->createOrder();
    $order->forceFill(
        ['order_status_uuid' => $this->createOrderStatus()->uuid]
    )->update();
    expect('')->toBe('');
    Event::assertDispatched(OrderStatusUpdated::class);
});

test('package listener can invoke webhook', function () {
    config()->set('order-status-notifications.webhook_url', 'http://webhook.test');
    Http::fake(['webhook.test' => Http::response('ok')]);

    $order = $this->createOrder();
    $event = new OrderStatusUpdated($order->uuid, $order->status->title, $order->updated_at);

    (new OnOrderStatusUpdatedCallWebhook())->handle($event);

    Http::assertSent(function (Request $request) {
        return $request->url() == 'http://webhook.test';
    });
});
