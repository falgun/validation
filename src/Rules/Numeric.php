<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

final class Numeric implements RuleInterface
{

    public function validate($value): bool
    {
        return \is_numeric($value);
    }

    public function getErrorMessage(): string
    {
        return '%s should be numeric!';
    }

    public function getName(): string
    {
        return 'Numeric';
    }
}
