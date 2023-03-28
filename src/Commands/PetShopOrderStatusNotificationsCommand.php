<?php

namespace PetShop\PetShopOrderStatusNotifications\Commands;

use Illuminate\Console\Command;

class PetShopOrderStatusNotificationsCommand extends Command
{
    public $signature = 'pet-shop-order-status-notifications';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
