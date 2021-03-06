<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

final class Ip implements RuleInterface
{

    public function validate($value): bool
    {
        return (\filter_var($value, \FILTER_VALIDATE_IP) !== false);
    }

    public function getErrorMessage(): string
    {
        return '%s should be an IP address!';
    }

    public function getName(): string
    {
        return 'Ip';
    }
}
