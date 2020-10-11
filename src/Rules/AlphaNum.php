<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

final class AlphaNum implements RuleInterface
{

    public function validate($value): bool
    {
        return \ctype_alnum($value);
    }

    public function getErrorMessage(): string
    {
        return '%s should only contain letters and numbers!';
    }

    public function getName(): string
    {
        return 'AlphaNum';
    }
}
