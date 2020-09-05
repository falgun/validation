<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

class MultipleFile implements RuleInterface
{

    const NAME = 'MultipleFile';

    public function validate($value): bool
    {
        if (\is_array($value) === false) {
            return false;
        }

        return \is_array(\current($value));
    }

    public function getErrorMessage(): string
    {
        return '%s should have multiple files !';
    }
}
