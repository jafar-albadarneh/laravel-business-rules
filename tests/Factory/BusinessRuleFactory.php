<?php
/**
 * Created by PhpStorm.
 * User: jafar
 * Date/Time: 12/09/2022 2:51 PM
 */

namespace Jafar\LaravelBusinessRules\Tests\Factory;

use Jafar\LaravelBusinessRules\Interfaces\Rulable;
use Mockery;

class BusinessRuleFactory
{
    public static function generateRule(bool $result, $errorMessage = null)
    {
        return Mockery::mock(Rulable::class)
            ->expects(function ($mock) use ($result, $errorMessage) {
                $mock->shouldReceive('run')->andReturn($result);
                $mock->shouldReceive('getErrorMessage')->andReturn($errorMessage);
            });
    }
}
