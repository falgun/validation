<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

final class RequiredFile implements RuleInterface
{

    public function validate($value): bool
    {
        $file = \current($value);
        if (\is_array($file)) {
            // multiple file
            return $this->hasNoError($file);
        }

        return $this->hasNoError($value);
    }

    private function hasNoError(array $file): bool
    {
        return (isset($file['error']) && $file['error'] !== \UPLOAD_ERR_NO_FILE);
    }

    public function getErrorMessage(): string
    {
        return '%s is required!';
    }

    public function getName(): string
    {
        return 'RequiredFile';
    }
}
