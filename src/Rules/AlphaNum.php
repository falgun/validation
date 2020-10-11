<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

class AlphaNum implements RuleInterface
{

    const NAME = 'AlphaNum';

    public function validate($value): bool
    {
        return \ctype_alnum($value);
    }

    public function getErrorMessage(): string
    {
        return '%s should only contain letters and numbers!';
    }
}
