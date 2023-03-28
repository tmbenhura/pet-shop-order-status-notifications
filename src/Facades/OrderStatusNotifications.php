<?php

declare(strict_types=1);

namespace PetShop\OrderStatusNotifications\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PetShop\OrderStatusNotifications\OrderStatusNotifications
 */
class OrderStatusNotifications extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \PetShop\OrderStatusNotifications\OrderStatusNotifications::class;
    }
}
