<?php
declare(strict_types=1);

namespace Falgun\Validation;

class ErrorBag implements \IteratorAggregate
{

    protected array $errors;

    public function __construct(array $errors = [])
    {
        $this->errors = $errors;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->errors);
    }

    public function all(): array
    {
        return $this->errors;
    }

    public function set(string $key, string $ruleName, string $error): void
    {
        $this->errors[$key][$ruleName] = $error;
    }
}
