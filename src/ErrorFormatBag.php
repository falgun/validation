<?php
declare(strict_types=1);

namespace Falgun\Validation;

final class ErrorFormatBag
{

    protected array $errorFormats;

    public function __construct(array $formats = [])
    {
        $this->errorFormats = $formats;
    }

    public function get(string $key): string
    {
        return $this->errorFormats[$key] ?? '';
    }
}
