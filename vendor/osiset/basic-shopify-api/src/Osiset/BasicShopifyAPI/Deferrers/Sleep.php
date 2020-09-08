<?php

namespace Osiset\BasicShopifyAPI\Deferrers;

use Osiset\BasicShopifyAPI\Contracts\TimeDeferrer;

/**
 * Base time deferrer implementation.
 * Based on spatie/guzzle-rate-limiter-middleware
 */
class Sleep implements TimeDeferrer
{
    /**
     * {@inheritDoc}
     */
    public function getCurrentTime(): float
    {
        return microtime(true);
    }

    /**
     * {@inheritDoc}
     */
    public function sleep(float $microseconds): void
    {
        usleep($microseconds);
    }
}
