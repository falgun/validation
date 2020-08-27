<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

class Email implements RuleInterface
{

    const NAME = 'Email';

    public function validate($value): bool
    {
        if ($value === null) {
            return false;
        }

        return (\filter_var($value, \FILTER_VALIDATE_EMAIL) !== false);
    }

    public function getErrorMessage(): string
    {
        return '%s should be an email address !';
    }
}
