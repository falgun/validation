<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

class Ip implements RuleInterface
{

    const NAME = 'Ip';

    public function validate($value): bool
    {
        if ($value === null) {
            return false;
        }

        return (\filter_var($value, \FILTER_VALIDATE_IP) !== false);
    }

    public function getErrorMessage(): string
    {
        return '%s should be an IP address !';
    }
}
