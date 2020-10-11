<?php

namespace Falgun\Validation\Rules;

interface RuleInterface
{

    public function getName(): string;

    public function validate($value): bool;

    public function getErrorMessage(): string;
}
