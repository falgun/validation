<?php
declare(strict_types=1);

namespace Falgun\Validation;

use Closure;
use Falgun\Validation\ErrorBag;
use Falgun\Validation\Rules\Custom;
use Falgun\Validation\ErrorFormatBag;
use Falgun\Validation\Rules\RuleInterface;

final class FileItem implements ItemInterface
{

    protected string $key;
    protected string $label;
    protected array $rules;
    protected bool $isOptional;

    public function __construct(string $key)
    {
        $this->key = $key;
        $this->rules = [];
        $this->isOptional = true;
        $this->label($key);
    }

    public function label(string $label): self
    {
        $this->label = $this->prepareLabel($label);
        return $this;
    }

    protected function prepareLabel(string $label): string
    {
        return ucwords(str_replace(['-', '_'], ' ', $label));
    }

    public function required(): self
    {
        $this->isOptional = false;

        $this->rules[] = new Rules\RequiredFile();

        return $this;
    }

    public function isImage(): self
    {
        $this->rules[] = new Rules\IsImage();

        return $this;
    }

    public function multipleFile(): self
    {
        $this->rules[] = new Rules\MultipleFile();

        return $this;
    }

    public function maxSize(int $maxSize): self
    {
        $this->rules[] = new Rules\MaxFileSize($maxSize);

        return $this;
    }

    public function custom(string $name, Closure $customRule): self
    {
        $this->rules[] = new Custom($name, $customRule);

        return $this;
    }

    public function validate($value, ErrorBag $errorBag, ErrorFormatBag $errorFormats): bool
    {

        if ($value === null && $this->isOptional === true) {
            return true;
        }

        $isPassed = true;

        foreach ($this->rules as $rule) {
            if (\is_array($value) === false || $rule->validate($value) === false) {
                $this->handleFailedRuleCase($rule, $errorBag, $errorFormats);
                $isPassed &= false;
            }
        }

        return ($isPassed & true) === 1;
    }

    protected function handleFailedRuleCase(RuleInterface $rule, ErrorBag $errorBag, ErrorFormatBag $errorFormats): void
    {
        $ruleName = $rule->getName();
        $format = $errorFormats->get($ruleName);

        if ($format === '') {
            $format = $rule->getErrorMessage();
        }

        $error = \sprintf($format, $this->label);

        $errorBag->set($this->key, $ruleName, $error);
    }

    public function setRule(RuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }
}
