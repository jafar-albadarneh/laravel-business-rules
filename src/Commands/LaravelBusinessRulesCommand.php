<?php

namespace Jafar\LaravelBusinessRules\Commands;

use Illuminate\Console\Command;

class LaravelBusinessRulesCommand extends Command
{
    public $signature = 'laravel-business-rules';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
