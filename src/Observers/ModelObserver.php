<?php

declare(strict_types=1);

namespace PetShop\OrderStatusNotifications\Observers;

use Illuminate\Database\Eloquent\Model;
use PetShop\OrderStatusNotifications\Events\OrderStatusUpdated;

class ModelObserver
{
    /**
     * Handle the Model "updated" event.
     */
    public function updated(Model $model): void
    {
        if ($model->isDirty('order_status_uuid')) {
            OrderStatusUpdated::dispatch($model->uuid, $model->status->title, $model->updated_at);
        }
    }
}
