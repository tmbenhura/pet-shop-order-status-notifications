<?php

declare(strict_types=1);

test('package has a default model configured', function () {
    expect(config('order-status-notifications.model'))->toBe('App\\Models\\Order');
});
