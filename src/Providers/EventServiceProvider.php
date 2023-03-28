<?php

declare(strict_types=1);

namespace PetShop\OrderStatusNotifications\Providers;

use PetShop\OrderStatusNotifications\Events\OrderStatusUpdated;
use PetShop\OrderStatusNotifications\Listeners\OnOrderStatusUpdatedCallWebhook;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderStatusUpdated::class => [
            OnOrderStatusUpdatedCallWebhook::class,
        ],
    ];
}
