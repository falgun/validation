<?php
declare(strict_types=1);

namespace Falgun\Validation;

use Closure;
use Falgun\Validation\Rules\Max;
use Falgun\Validation\Rules\Min;
use Falgun\Validation\Rules\Custom;
use Falgun\Validation\Rules\Required;
use Falgun\Validation\Rules\RuleInterface;

class Item
{

    protected string $key;
    protected array $rules;
    protected bool $isOptional;

    public function __construct(string $key)
    {
        $this->key = $key;
        $this->rules = [];
        $this->isOptional = true;
    }

    public function required(): self
    {
        $this->isOptional = false;

        $this->rules[] = new Required();

        return $this;
    }

    public function min(int $min): self
    {
        $this->rules[] = new Min($min);

        return $this;
    }

    public function max(int $limit): self
    {
        $this->rules[] = new Max($limit);

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
            if ($rule->validate($value) === false) {
                $this->handleFailedRuleCase($rule, $errorBag, $errorFormats);
                $isPassed &= false;
            }
        }

        return ($isPassed & true) === 1;
    }

    protected function handleFailedRuleCase(RuleInterface $rule, ErrorBag $errorBag, ErrorFormatBag $errorFormats): void
    {
        $ruleName = ($rule instanceof Custom) ? $rule->getName() : $rule::NAME;
        $format = $errorFormats->get($ruleName);

        if ($format === '') {
            $format = $rule->getErrorMessage();
        }

        $error = \sprintf($format, $this->key);

        $errorBag->set($this->key, $ruleName, $error);
    }
}
