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
        return strlen($value) >= $this->min;
    }

    public function getErrorMessage(): string
    {
        return '%s should be atleast ' . $this->min . ' characters!';
    }
}
