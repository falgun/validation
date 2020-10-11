<?php
declare(strict_types=1);

namespace Falgun\Validation;

use Closure;
use Falgun\Validation\Rules\Ip;
use Falgun\Validation\Rules\Url;
use Falgun\Validation\Rules\Email;
use Falgun\Validation\Rules\IsArray;
use Falgun\Validation\Rules\AlphaNum;
use Falgun\Validation\Rules\AlphaNumWords;
use Falgun\Validation\Rules\MaxLen;
use Falgun\Validation\Rules\MinLen;
use Falgun\Validation\Rules\Custom;
use Falgun\Validation\Rules\Numeric;
use Falgun\Validation\Rules\Required;
use Falgun\Validation\Rules\RuleInterface;

final class Item implements ItemInterface
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

        $this->rules[] = new Required();

        return $this;
    }

    public function minLen(int $min): self
    {
        $this->rules[] = new MinLen($min);

        return $this;
    }

    public function maxLen(int $limit): self
    {
        $this->rules[] = new MaxLen($limit);

        return $this;
    }

    public function numeric(): self
    {
        $this->rules[] = new Numeric();

        return $this;
    }

    public function email(): self
    {
        $this->rules[] = new Email();

        return $this;
    }

    public function url(): self
    {
        $this->rules[] = new Url();

        return $this;
    }

    public function ip(): self
    {
        $this->rules[] = new Ip();

        return $this;
    }

    public function alphaNum(): self
    {
        $this->rules[] = new AlphaNum();

        return $this;
    }

    public function alphaNumWords(): self
    {
        $this->rules[] = new AlphaNumWords();

        return $this;
    }

    public function isArray(): self
    {
        $this->rules[] = new IsArray();

        return $this;
    }

    public function matchWith(Item $item): self
    {
        $rule = new Rules\MatchWith($this->label);

        // same rule will be called twice
        $item->setRule($rule);
        $this->setRule($rule);

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
            if ($value === null || $rule->validate($value) === false) {
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
