<?php

namespace Jafar\LaravelBusinessRules\Interfaces;

interface Rulable
{
    public function run(): bool;

    public function getErrorMessage(): ?string;

    public function getSeverityLevel(): ?int;
}
