<?php
declare(strict_types=1);

namespace Falgun\Validation;

use Falgun\Notification\NotificationInterface;

class Validator
{

    protected array $items;
    protected ErrorBag $errorBag;
    protected ErrorFormatBag $errorFormats;
    protected NotificationInterface $notification;

    public function __construct(NotificationInterface $notification = null, $errorFormats = null)
    {
        $this->items = [];

        if ($errorFormats === null) {
            $errorFormats = new ErrorFormatBag();
        }

        $this->errorFormats = $errorFormats;

        if ($notification !== null) {
            $this->notification = $notification;
        }
    }

    public function select(string $name): Item
    {
        return $this->items[$name] = new Item($name);
    }

    public function validate(array $values): bool
    {
        $this->errorBag = new ErrorBag();

        $isPassed = true;

        foreach ($this->items as $name => $item) {
            $isPassed &= $item->validate(
                $values[$name] ?? null,
                $this->errorBag,
                $this->errorFormats,
            );
        }

        $isAllRulePassed = ($isPassed & true) === 1;

        if ($isAllRulePassed === false && isset($this->notification)) {
            $this->setToNofication($this->errorBag);
        }

        return $isAllRulePassed;
    }

    public function errors(): ErrorBag
    {
        return $this->errorBag;
    }

    protected function setToNofication(ErrorBag $errorBag): void
    {
        foreach ($errorBag as $errors) {
            foreach ($errors as $error) {
                $this->notification->warningNote($error);
            }
        }
    }
}
