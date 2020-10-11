<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

final class MultipleFile implements RuleInterface
{

    const NAME = 'MultipleFile';

    public function validate($value): bool
    {
        return \is_array(\current($value));
    }

    public function getErrorMessage(): string
    {
        return '%s should have multiple files!';
    }
}
