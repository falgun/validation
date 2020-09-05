<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

class RequiredFile implements RuleInterface
{

    const NAME = 'RequiredFile';

    public function validate($value): bool
    {
        if (\is_array($value) === false) {
            return false;
        }

        $file = \current($value);
        if (\is_array($file)) {
            // multiple file
            return $this->hasNoError($file);
        }

        return $this->hasNoError($value);
    }

    private function hasNoError($file): bool
    {
        return (isset($file['error']) && $file['error'] === 0);
    }

    public function getErrorMessage(): string
    {
        return '%s is required!';
    }
}
