<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait UsesUuid
{
    /**
     * Add Event Listener to add an uuid on "creating" event
     *
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     */
    protected static function bootUsesUuid()
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Disable auto increment
     *
     * @return bool
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Set Key
     *
     * @return string
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     */
    public function getKeyType()
    {
        return 'string';
    }
}
