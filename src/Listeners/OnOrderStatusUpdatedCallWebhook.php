<?php

namespace PetShop\OrderStatusNotifications\Listeners;

use Illuminate\Support\Facades\Http;
use PetShop\OrderStatusNotifications\Events\OrderStatusUpdated;

class OnOrderStatusUpdatedCallWebhook
{
    /**
     * Handle order update.
     */
    public function handle(OrderStatusUpdated $event)
    {
        $webhookUrl = config('order-status-notifications.webhook_url');

        Http::withOptions(
            [
                'connect_timeout' => 60,
            ]
        )->post($webhookUrl, json_decode($this->cardJson($event)));
    }

    private function cardJson(OrderStatusUpdated $event): string
    {
        $model = config('order-status-notifications.model');
        $order = $model::where('uuid', $event->orderUuid)->first();

        return <<<JSON
{
    "@type": "MessageCard",
    "@context": "http://schema.org/extensions",
    "themeColor": "0076D7",
    "summary": "Order status has been updated for {$order->user->first_name} {$order->user->last_name}",
    "sections": [{
        "activityTitle": "Order status is {$order->status->title}",
        "activitySubtitle": "Order updated",
        "activityImage": "https://teamsnodesample.azurewebsites.net/static/img/image5.png",
        "facts": [{
            "name": "Assigned to",
            "value": "Unassigned"
        }, {
            "name": "Due date",
            "value": "Mon May 01 2017 17:07:18 GMT-0700 (Pacific Daylight Time)"
        }, {
            "name": "Status",
            "value": "Not started"
        }],
        "markdown": true
    }],
    "potentialAction": [{
        "@type": "ActionCard",
        "name": "View Pdf",
        "inputs": [{
            "@type": "TextInput",
            "id": "comment",
            "isMultiline": false,
            "title": "Add a comment here for this task"
        }],
        "actions": [{
            "@type": "HttpPOST",
            "name": "Add comment",
            "target": "https://learn.microsoft.com/outlook/actionable-messages"
        }]
    }, {
        "@type": "ActionCard",
        "name": "Cancel Order",
        "inputs": [{
            "@type": "DateInput",
            "id": "dueDate",
            "title": "Enter a due date for this task"
        }],
        "actions": [{
            "@type": "HttpPOST",
            "name": "Save",
            "target": "https://learn.microsoft.com/outlook/actionable-messages"
        }]
    }, {
        "@type": "ActionCard",
        "name": "Update Status",
        "inputs": [{
            "@type": "MultichoiceInput",
            "id": "list",
            "title": "Select a status",
            "isMultiSelect": "false",
            "choices": [{
                "display": "In Progress",
                "value": "1"
            }, {
                "display": "Active",
                "value": "2"
            }, {
                "display": "Closed",
                "value": "3"
            }]
        }],
        "actions": [{
            "@type": "HttpPOST",
            "name": "Save",
            "target": "https://learn.microsoft.com/outlook/actionable-messages"
        }]
    }]
}
JSON;
    }
}
