<?php

declare(strict_types=1);

/**
 * Config for PetShop Order Status Notifications
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Order Model
    |--------------------------------------------------------------------------
    |
    | The order model to monitor for changes
    |
    */
    'model' => env('OSN_MODEL', 'App\\Models\\Order'),
];
