<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

final class Url implements RuleInterface
{

    const NAME = 'Url';

    public function validate($value): bool
    {
        return (\filter_var($value, \FILTER_VALIDATE_URL) !== false);
    }

    public function getErrorMessage(): string
    {
        return '%s should be an url address!';
    }
}
