<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

use Closure;

final class Custom implements RuleInterface
{

    private string $name;
    private Closure $customRule;
    private string $errorMessage;

    public function __construct(string $name, Closure $customRule)
    {
        $this->name = $name;
        $this->customRule = $customRule;
        $this->errorMessage = '%s is invalid!';
    }

    public function validate($value): bool
    {
        return ($this->customRule)($value, $this);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(string $message): void
    {
        $this->errorMessage = $message;
    }
}
