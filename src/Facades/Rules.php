<?php

namespace Jafar\LaravelBusinessRules\Facades;

use Illuminate\Support\Facades\Facade;

class Rules extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Rules';
    }
}
