<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

class Min implements RuleInterface
{

    const NAME = 'Max';

    protected int $min;

    public function __construct(int $min)
    {
        $this->min = $min;
    }

    public function validate($value): bool
    {
        return strlen($value) >= $this->min;
    }

    public function getErrorMessage(): string
    {
        return '%s should be more than ' . $this->min . ' characters !';
    }
}
