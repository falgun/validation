<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

class MaxFileSize implements RuleInterface
{

    const NAME = 'MaxFileSize';

    private int $maxSize;

    public function __construct(int $maxSize)
    {
        $this->maxSize = $maxSize;
    }

    public function validate($value): bool
    {
        if (\is_array(\current($value))) {
            // multiple file
            return $this->validateArrayFiles($value);
        }

        return $this->checkFileSize($value);
    }

    private function validateArrayFiles(array $files): bool
    {
        $isPassed = true;
        foreach ($files as $file) {
            $isPassed &= $this->checkFileSize($file);
        }

        return ($isPassed & true) === 1;
    }

    private function checkFileSize(array $value): bool
    {
        if (isset($value['error']) && $value['error'] === \UPLOAD_ERR_NO_FILE) {
            return true;
        }

        if (empty($value['size'])) {
            return false;
        }

        return $value['size'] <= $this->maxSize;
    }

    public function getErrorMessage(): string
    {
        return '%s should be less than ' . $this->maxSize . ' bytes!';
    }
}
