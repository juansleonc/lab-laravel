<?php

namespace Teachme\Entities;

use Illuminate\Database\Eloquent\Model;

class entity extends Model
{
    public static function getClass()
    {
        return get_class(new static());
    }
}
