<?php

namespace Falgun\Validation;

use Closure;
use Falgun\Validation\ErrorBag;
use Falgun\Validation\ErrorFormatBag;
use Falgun\Validation\Rules\RuleInterface;

interface ItemInterface
{

    public function label(string $label): self;

    public function custom(string $name, Closure $customRule): self;

    public function validate($value, ErrorBag $errorBag, ErrorFormatBag $errorFormats): bool;

    public function setRule(RuleInterface $rule): void;
}
