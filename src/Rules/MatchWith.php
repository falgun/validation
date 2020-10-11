<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

final class MatchWith implements RuleInterface
{

    private $parentValue;
    private string $parentLabel;

    public function __construct(string $parentLabel)
    {
        $this->parentLabel = $parentLabel;
    }

    public function validate($value): bool
    {
        if ($this->parentValue === null) {
            // this is the first time this rule is being called
            // So, Main Item is getting checked
            // Let's assign parent value 
            // so We can compare it when this rule called second time
            $this->parentValue = $value;

            return true;
        }
        // this is second time
        // we need to compare this value with previous value

        return $value === $this->parentValue;
    }

    public function getErrorMessage(): string
    {
        return '%s should contain same value as ' . $this->parentLabel . '!';
    }

    public function getName(): string
    {
        return 'MatchWith';
    }
}
