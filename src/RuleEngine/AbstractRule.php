<?php
/**
 * Created by PhpStorm.
 * User: jafar
 * Date/Time: 07/09/2022 12:48 AM
 */

namespace Jafar\LaravelBusinessRules\RuleEngine;

use Exception;
use Jafar\LaravelBusinessRules\Interfaces\Rulable;

class AbstractRule implements Rulable
{

    /**
     * @throws Exception
     */
    public function run(): bool
    {
        throw new Exception('Method run() must be implemented');
    }

    /**
     * @throws Exception
     */
    public function getErrorMessage(): ?string
    {
        throw new Exception('Method getErrorMessage() must be implemented');
    }

    public function getSeverityLevel(): ?int
    {
        return null;
    }
}
