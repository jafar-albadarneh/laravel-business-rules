<?php

namespace Jafar\LaravelBusinessRules;

use Illuminate\Support\Facades\App;
use Jafar\LaravelBusinessRules\Commands\LaravelBusinessRulesCommand;
use Jafar\LaravelBusinessRules\RuleEngine\RulesBus;
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
        $provider = parent::register();
        App::bind('Rules', function () {
            return new RulesBus();
        });

        return $provider;
    }
}
