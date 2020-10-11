<?php
declare(strict_types=1);

namespace Falgun\Validation;

use Falgun\Notification\NotificationInterface;

final class Validator
{

    protected array $items;
    protected array $fileItems;
    protected ErrorBag $errorBag;
    protected ErrorFormatBag $errorFormats;
    protected ?NotificationInterface $notification;

    public function __construct(NotificationInterface $notification = null, ErrorFormatBag $errorFormats = null)
    {
        $this->items = [];
        $this->fileItems = [];
        $this->errorBag = new ErrorBag();

        if ($errorFormats === null) {
            $errorFormats = new ErrorFormatBag();
        }

        $this->errorFormats = $errorFormats;

        $this->notification = $notification;
    }

    public function select(string $name): Item
    {
        return $this->items[$name] = new Item($name);
    }

    public function file(string $name): FileItem
    {
        return $this->fileItems[$name] = new FileItem($name);
    }

    public function validate(array $postDatas, array $files = []): bool
    {
        // we want to reset error bag on each validation
        $this->errorBag = new ErrorBag();

        $postItemsPassed = $this->validateItems($this->items, $postDatas);
        $fileItemsPassed = $this->validateItems($this->fileItems, $files);

        $isAllItemsPassed = $postItemsPassed && $fileItemsPassed;

        if ($isAllItemsPassed === false) {
            $this->setToNofication($this->errorBag);
        }

        return $isAllItemsPassed;
    }

    private function validateItems(array $items, array $values): bool
    {
        $isPassed = true;

        foreach ($items as $name => $item) {
            $isPassed &= $item->validate(
                $values[$name] ?? null,
                $this->errorBag,
                $this->errorFormats,
            );
        }

        $isAllRulePassed = ($isPassed & true) === 1;

        return $isAllRulePassed;
    }

    public function errors(): ErrorBag
    {
        return $this->errorBag;
    }

    protected function setToNofication(ErrorBag $errorBag): void
    {
        if (isset($this->notification) === false) {
            return;
        }

        foreach ($errorBag as $errors) {
            foreach ($errors as $error) {
                $this->notification->warningNote($error);
            }
        }
    }
}
