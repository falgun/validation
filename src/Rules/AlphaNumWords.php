<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

final class AlphaNumWords implements RuleInterface
{

    const NAME = 'AlphaNumWords';

    public function validate($value): bool
    {
        return \preg_match('/[^a-zA-Z0-9\ ]/', $value) !== 1;
    }

    public function getErrorMessage(): string
    {
        return '%s should only contain letters, numbers and spaces!';
    }
}
