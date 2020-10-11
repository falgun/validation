<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

final class IsArray implements RuleInterface
{

    public function validate($value): bool
    {
        return \is_array($value);
    }

    public function getErrorMessage(): string
    {
        return '%s should be an array!';
    }

    public function getName(): string
    {
        return 'IsArray';
    }
}
