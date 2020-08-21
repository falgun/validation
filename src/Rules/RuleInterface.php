<?php

namespace Falgun\Validation\Rules;

interface RuleInterface
{

    public function validate($value): bool;

    public function getErrorMessage(): string;
}
