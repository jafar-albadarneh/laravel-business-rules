<?php

namespace Jafar\LaravelBusinessRules;

use Jafar\LaravelBusinessRules\Commands\LaravelBusinessRulesCommand;
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
            ->hasViews()
            ->hasMigration('create_laravel-business-rules_table')
            ->hasCommand(LaravelBusinessRulesCommand::class);
    }
}
