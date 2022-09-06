<?php

namespace Jafar\LaravelBusinessRules\Tests\Unit\RuleEngine;

use Exception;
use Jafar\LaravelBusinessRules\Facades\Rules;
use Jafar\LaravelBusinessRules\Interfaces\Rulable;
use Jafar\LaravelBusinessRules\RuleEngine\AbstractRule;
use Jafar\LaravelBusinessRules\RuleEngine\RuleResult;
use Jafar\LaravelBusinessRules\Tests\TestCase;

class RulesTest extends TestCase
{
    protected Rulable $passingRule;

    protected Rulable $failingRule;

    protected Rulable $invalidRule;

    protected function setUp(): void
    {
        parent::setUp();
        $this->passingRule = new class extends AbstractRule
        {
            public function run(): bool
            {
                return true;
            }

            public function getErrorMessage(): string
            {
                return 'success';
            }
        };

        $this->failingRule = new class extends AbstractRule
        {
            public function run(): bool
            {
                return false;
            }

            public function getErrorMessage(): string
            {
                return 'invalid';
            }
        };

        $this->invalidRule = new class extends AbstractRule
        {
            public function run(): bool
            {
                return false;
            }
        };
    }

    /** @test */
    public function it_should_throw_an_exception_if_rule_class_does_not_implement_all_necessary_methods()
    {
        $this->expectException(Exception::class);
        Rules::apply([
            $this->invalidRule,
        ]);
    }

    /** @test */
    public function it_returns_rules_results_as_object_of_RuleResult()
    {
        $rules = Rules::apply([
            $this->passingRule,
        ]);
        $this->assertInstanceOf(RuleResult::class, $rules->results()->first());
        $this->assertNull($rules->results()->first()->getErrorMessage());
    }

    /** @test */
    public function it_fills_rule_results_with_valid_data()
    {
        $rules = Rules::apply([
            $this->failingRule,
        ]);

        $results = $rules->results();
        $this->assertTrue($results->first()->hasFailed());
        $this->assertEquals('invalid', $results->first()->getErrorMessage());
    }

    /** @test */
    public function rules_execution_results_can_be_accessed_as_aggregate()
    {
        $rules = Rules::apply([
            $this->failingRule,
        ]);
        $this->assertTrue($rules->hasFailures());
        $this->assertFalse($rules->allPassed());
    }

    /** @test */
    public function it_returns_first_failing_rule_message_in_case_any_rule_failed()
    {
        $rules = Rules::apply([
            $this->passingRule,
            $this->failingRule,
        ]);

        $this->assertEquals('invalid', $rules->failedDueTo()->getErrorMessage());
    }

    /** @test */
    public function it_returns_bad_request_status_code_if_one_of_the_rules_failed()
    {
        $rules = Rules::apply([
            $this->passingRule,
            $this->failingRule,
        ]);

        $this->assertEquals(400, $rules->failedDueTo()->getStatusCode());
    }
}
