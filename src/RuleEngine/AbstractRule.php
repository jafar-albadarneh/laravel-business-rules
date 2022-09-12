<?php
/**
 * Created by PhpStorm.
 * User: jafar
 * Date/Time: 07/09/2022 12:48 AM
 */

namespace Jafar\LaravelBusinessRules\RuleEngine;

use Exception;
use Jafar\LaravelBusinessRules\Interfaces\Rulable;

abstract class AbstractRule implements Rulable
{
    /**
     * @throws Exception
     */
    public abstract function run(): bool;

    /**
     * @throws Exception
     */
    public abstract function getErrorMessage(): ?string;

    public function getSeverityLevel(): ?int
    {
        return null;
    }
}
