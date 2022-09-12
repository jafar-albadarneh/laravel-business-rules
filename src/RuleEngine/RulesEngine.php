<?php

namespace Jafar\LaravelBusinessRules\RuleEngine;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Jafar\LaravelBusinessRules\Exceptions\RuleResultException;
use Jafar\LaravelBusinessRules\Interfaces\Rulable;

class RulesEngine
{
    protected Collection $results;

    public function __construct()
    {
        $this->results = collect();
    }

    public function apply($rules): self
    {
        collect($rules)->map(function (Rulable $rule) {
            $ruleResult = new RuleResult($rule);
            $ruleResult->setResult($rule->run());
            if ($ruleResult->hasFailed()) {
                $ruleResult->setErrorMessage($rule->getErrorMessage());
                $ruleResult->setStatusCode(400);
                $ruleResult->setIsCritical($rule->getSeverityLevel() ?? false);
                if ($ruleResult->isCritical()) {
                    $ruleResult->setSeverity(400);
                }
            }
            $this->results->push($ruleResult);
        });

        return $this;
    }

    public function results(): Collection
    {
        return $this->results;
    }

    public function allPassed(): bool
    {
        return $this->results->every(function (RuleResult $result) {
            return $result->isSuccessful();
        });
    }

    public function hasFailures(): bool
    {
        return $this->results->contains(function (RuleResult $result) {
            return $result->hasFailed();
        });
    }

    public function getFailedRules(): Collection
    {
        return $this->results->filter(function (RuleResult $result) {
            return $result->hasFailed();
        });
    }

    public function failedDueTo(): RuleResult
    {
        return $this->results->first(function (RuleResult $result) {
            return $result->hasFailed();
        });
    }

    public function toResponse(): JsonResponse
    {
        $failingRule = $this->failedDueTo();

        return response()->json([
            'message' => $failingRule->getErrorMessage(),
            'success' => false,
            'status_code' => $failingRule->getStatusCode(),
        ], $failingRule->getStatusCode());
    }

    /**
     * @throws RuleResultException
     */
    public function toException()
    {
        $failingRule = $this->failedDueTo();
        throw new RuleResultException($failingRule);
    }

    public function resetCollection(): Collection
    {
        return $this->results = collect();
    }
}
