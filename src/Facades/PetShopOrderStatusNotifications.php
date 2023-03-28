<?php

namespace PetShop\PetShopOrderStatusNotifications\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PetShop\PetShopOrderStatusNotifications\PetShopOrderStatusNotifications
 */
class PetShopOrderStatusNotifications extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \PetShop\PetShopOrderStatusNotifications\PetShopOrderStatusNotifications::class;
    }
}
