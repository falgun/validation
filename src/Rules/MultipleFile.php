<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

final class MultipleFile implements RuleInterface
{

    public function validate($value): bool
    {
        return \is_array(\current($value));
    }

    public function getErrorMessage(): string
    {
        return '%s should have multiple files!';
    }

    public function getName(): string
    {
        return 'MultipleFile';
    }
}
