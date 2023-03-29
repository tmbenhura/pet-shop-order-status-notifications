# Order Status Notifications for Pet Shop API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tmbenhura/pet-shop-order-status-notifications.svg?style=flat-square)](https://packagist.org/packages/tmbenhura/pet-shop-order-status-notifications)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/tmbenhura/pet-shop-order-status-notifications/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tmbenhura/pet-shop-order-status-notifications/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/tmbenhura/pet-shop-order-status-notifications/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/tmbenhura/pet-shop-order-status-notifications/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/tmbenhura/pet-shop-order-status-notifications.svg?style=flat-square)](https://packagist.org/packages/tmbenhura/pet-shop-order-status-notifications)

Order status notifications task.

## Installation

You can install the package via composer:

```bash
composer require tmbenhura/pet-shop-order-status-notifications
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="pet-shop-order-status-notifications-config"
```

This is the contents of the published config file:

```php
return [
    'model' => env('OSN_MODEL', 'App\\Models\\Order'),
    'webhook_url' => env('OSN_WEBHOOK_URL', ''),
];
```

## Usage

Package will invoke webhook automatically a statuses change.

## Testing

```bash
composer test
```