<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

class Numeric implements RuleInterface
{

    const NAME = 'Numeric';

    public function validate($value): bool
    {
        return \is_numeric($value);
    }

    public function getErrorMessage(): string
    {
        return '%s should be numeric!';
    }
}
