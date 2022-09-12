<?php
/**
 * Created by PhpStorm.
 * User: jafar
 * Date/Time: 12/09/2022 2:42 PM
 */

namespace Jafar\LaravelBusinessRules\Tests\Unit\Actions;

use Jafar\LaravelBusinessRules\Exceptions\RuleResultException;
use Jafar\LaravelBusinessRules\Interfaces\Actionable;
use Jafar\LaravelBusinessRules\Interfaces\Rulable;
use Jafar\LaravelBusinessRules\RuleEngine\AbstractRulableAction;
use Jafar\LaravelBusinessRules\Tests\TestCase;

class RuleAwareActionTest extends TestCase
{
    protected AbstractRulableAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new class extends AbstractRulableAction implements Actionable
        {
            public function execute(...$args)
            {
                return true;
            }
        };
    }

    /** @test
     * @throws RuleResultException
     */
    public function it_should_allow_running_action_classes_with_rules()
    {
        $action = $this->action->requires([$this->passingRule]);
        $this->assertInstanceOf(AbstractRulableAction::class, $action);
        $this->assertCount(1, $action->getRules());
        //$this->assertInstanceOf(Rulable::class, $action->getRules()[0]);
    }

    /** @test
     * @throws RuleResultException
     */
    public function it_should_throw_an_exception_when_running_action_classes_with_failing_rules()
    {
        $this->expectException(RuleResultException::class);
        $this->action
            ->requires([
                $this->failingRule,
            ])
            ->execute();
    }

    /** @test
     * @throws RuleResultException
     */
    public function it_should_allow_running_action_classes_with_passing_rules()
    {
        $result = $this->action
            ->requires([
                $this->passingRule,
            ])
            ->execute();
        $this->assertTrue($result);
    }

    /** @test */
    public function it_should_throw_an_exception_with_correct_reason()
    {
        try {
            $this->action
                ->requires([
                    $this->passingRule,
                    $this->failingRule,
                ])
                ->execute();
        } catch (RuleResultException $exception) {
            $this->assertEquals('invalid', $exception->getMessage());
        }
    }
}
