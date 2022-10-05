<?php
/**
 * Created by PhpStorm.
 * User: jafar
 * Date/Time: 12/09/2022 3:21 PM
 */

namespace Jafar\LaravelBusinessRules\Interfaces;

interface Actionable
{
    public function execute(...$args);
}
