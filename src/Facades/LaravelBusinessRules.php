<?php

namespace Jafar\LaravelBusinessRules\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Jafar\LaravelBusinessRules\LaravelBusinessRules
 */
class LaravelBusinessRules extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Jafar\LaravelBusinessRules\LaravelBusinessRules::class;
    }
}
