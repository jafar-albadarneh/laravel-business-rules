<?php

namespace Jafar\LaravelBusinessRules\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jafar\LaravelBusinessRules\LaravelBusinessRulesServiceProvider;
use Jafar\LaravelBusinessRules\RuleEngine\AbstractRule;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected $passingRule;

    protected $failingRule;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Jafar\\LaravelBusinessRules\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        $this->passingRule = $this->getMockForAbstractClass(AbstractRule::class);
        $this->passingRule->expects($this->any())
            ->method('run')
            ->will($this->returnValue(true));
        $this->passingRule->expects($this->any())
            ->method('getErrorMessage')
            ->will($this->returnValue('success'));

        $this->failingRule = $this->getMockForAbstractClass(AbstractRule::class);
        $this->failingRule->expects($this->any())
            ->method('run')
            ->will($this->returnValue(false));
        $this->failingRule->expects($this->any())
            ->method('getErrorMessage')
            ->will($this->returnValue('failed'));
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelBusinessRulesServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-business-rules_table.php.stub';
        $migration->up();
        */
    }
}
