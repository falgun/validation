<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

final class MaxLen implements RuleInterface
{

    const NAME = 'Max';

    private int $limit;

    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    public function validate($value): bool
    {
        return strlen($value) <= $this->limit;
    }

    public function getErrorMessage(): string
    {
        return '%s should be within ' . $this->limit . ' characters!';
    }
}
