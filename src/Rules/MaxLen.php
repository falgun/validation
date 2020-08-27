<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

class MaxLen implements RuleInterface
{

    const NAME = 'Max';

    protected int $limit;

    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    public function validate($value): bool
    {
        if ($value === null) {
            return false;
        }

        return strlen($value) <= $this->limit;
    }

    public function getErrorMessage(): string
    {
        return '%s should be less than ' . $this->limit . ' characters !';
    }
}
