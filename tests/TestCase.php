<?php

namespace Jafar\LaravelBusinessRules\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jafar\LaravelBusinessRules\Interfaces\Rulable;
use Jafar\LaravelBusinessRules\LaravelBusinessRulesServiceProvider;
use Jafar\LaravelBusinessRules\RuleEngine\AbstractRule;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected Rulable $passingRule;

    protected Rulable $failingRule;

    protected Rulable $invalidRule;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Jafar\\LaravelBusinessRules\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        $this->passingRule = new class extends AbstractRule implements Rulable
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

        $this->failingRule = new class extends AbstractRule implements Rulable
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

        $this->invalidRule = new class extends AbstractRule implements Rulable
        {
            public function run(): bool
            {
                return false;
            }
        };
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
