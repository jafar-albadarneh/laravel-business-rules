<?php

namespace Jafar\LaravelBusinessRules;

use Jafar\LaravelBusinessRules\Commands\LaravelBusinessRulesCommand;
use Jafar\LaravelBusinessRules\RuleEngine\RulesEngine;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelBusinessRulesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-business-rules')
            ->hasConfigFile()
            ->hasCommand(LaravelBusinessRulesCommand::class);
    }

    public function register()
    {
        parent::register();
        app()->bind('Rules', function () {
            return new RulesEngine();
        });
    }
}
