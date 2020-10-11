<?php
declare(strict_types=1);

namespace Falgun\Validation\Rules;

use const PATHINFO_EXTENSION;

final class IsImage implements RuleInterface
{

    const NAME = 'IsImage';

    /**
     * @todo Bad implementation
     * @FIXIT
     */
    public function validate($value): bool
    {
        if (\is_array(\current($value))) {
            // multiple file
            return $this->validateArrayFiles($value);
        }

        return $this->checkImageExtension($value);
    }

    private function validateArrayFiles(array $files): bool
    {
        $isAllImage = true;
        foreach ($files as $file) {
            $isAllImage &= $this->checkImageExtension($file);
        }

        return ($isAllImage & true) === 1;
    }

    private function checkImageExtension(array $value): bool
    {
        if (isset($value['error']) && $value['error'] === 4) {
            return true;
        }

        if (empty($value['name'])) {
            return false;
        }

        $imgExt = array('jpg', 'jpeg', 'png', 'gif', 'webp');

        return \in_array(\strtolower(\pathinfo($value['name'], PATHINFO_EXTENSION)), $imgExt);
    }

    public function getErrorMessage(): string
    {
        return '%s should be an image file!';
    }
}
