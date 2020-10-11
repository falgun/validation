<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

final class Required implements RuleInterface
{

    public function validate($value): bool
    {
        return $value !== '';
    }

    public function getErrorMessage(): string
    {
        return '%s is required!';
    }

    public function getName(): string
    {
        return 'Required';
    }
}
