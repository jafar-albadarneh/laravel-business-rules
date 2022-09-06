<?php

namespace Jafar\LaravelBusinessRules\Exceptions;

use Exception;
use Jafar\LaravelBusinessRules\RuleEngine\RuleResult;

class RuleResultException extends Exception
{
    protected RuleResult $ruleResult;

    public function __construct(RuleResult $ruleResult)
    {
        $this->ruleResult = $ruleResult;
        parent::__construct($ruleResult->getErrorMessage(), $ruleResult->getStatusCode());
    }

    /**
     * @return RuleResult
     */
    public function ruleResult(): RuleResult
    {
        return $this->ruleResult;
    }
}
