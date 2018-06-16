<?php

namespace App;

use App\Concerns\ReadOnly;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use ReadOnly;
}
