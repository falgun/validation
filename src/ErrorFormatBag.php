<?php
declare(strict_types=1);

namespace Falgun\Validation;

class ErrorFormatBag implements \IteratorAggregate
{

    protected array $errorFormats;

    public function __construct(array $formats = [])
    {
        $this->errorFormats = $formats;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->errorFormats);
    }

    public function get(string $key): string
    {
        return $this->errorFormats[$key] ?? '';
    }
}
