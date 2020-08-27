<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

class MinLen implements RuleInterface
{

    const NAME = 'Min';

    protected int $min;

    public function __construct(int $min)
    {
        $this->min = $min;
    }

    public function validate($value): bool
    {
        if ($value === null) {
            return false;
        }

        return strlen($value) >= $this->min;
    }

    public function getErrorMessage(): string
    {
        return '%s should be more than ' . $this->min . ' characters !';
    }
}
