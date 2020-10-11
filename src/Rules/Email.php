<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

final class Email implements RuleInterface
{

    const NAME = 'Email';

    public function validate($value): bool
    {
        return (\filter_var($value, \FILTER_VALIDATE_EMAIL) !== false);
    }

    public function getErrorMessage(): string
    {
        return '%s should be an email address!';
    }
}
