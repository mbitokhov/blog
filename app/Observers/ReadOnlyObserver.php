<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyObserver
{
    public static function saving(Model $model)
    {
        return false;
    }

    public static function deleting(Model $model)
    {
        return false;
    }
}
