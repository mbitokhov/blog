<?php

namespace App\Concerns;

use App\Observers\ReadOnlyObserver;

trait ReadOnly
{
    protected static function bootReadOnly()
    {
        $env = mb_strtolower(config('app.env'));

        if ($env === 'demo') {
            static::observe(ReadOnlyObserver::class);
        }
    }
}
