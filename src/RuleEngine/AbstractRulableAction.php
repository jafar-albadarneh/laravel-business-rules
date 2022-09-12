<?php
/**
 * Created by PhpStorm.
 * User: jafar
 * Date/Time: 12/09/2022 2:45 PM
 */

namespace Jafar\LaravelBusinessRules\RuleEngine;

use Jafar\LaravelBusinessRules\Exceptions\RuleResultException;
use Jafar\LaravelBusinessRules\Interfaces\Rulable;

abstract class AbstractRulableAction
{
    /**
     * @var Rulable[]
     */
    protected array $rules = [];

    /**
     * @param  Rulable[]  $rules
     * @return $this
     *
     * @throws RuleResultException
     */
    public function requires(array $rules): self
    {
        $this->rules = array_merge($this->rules, $rules);
        $results = app(RulesEngine::class)->apply($this->rules);
        if ($results->hasFailures()) {
            $results->toException();
        }

        return $this;
    }

    public function getRules(): array
    {
        return $this->rules;
    }
}
