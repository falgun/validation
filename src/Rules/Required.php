<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

class Required implements RuleInterface
{

    const NAME = 'Required';

    public function validate($value): bool
    {
        return $value !== null && $value !== '';
    }

    public function getErrorMessage(): string
    {
        return '%s is required!';
    }
}
