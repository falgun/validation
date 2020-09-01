<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests;

use PHPUnit\Framework\TestCase;
use Falgun\Validation\Validator;
use Falgun\Notification\Notification;
use Falgun\Notification\Notes\BootstrapNote;

class ValidationNotificationTest extends TestCase
{

    public function testNotificationSystem()
    {
        $notification = new Notification(new MockSession(), BootstrapNote::class);
        $validation = new Validator($notification);

        $validation->select('name')->required();
        // we are passing blank array, so validation will fail
        if ($validation->validate([])) {
            // do something
        }

        $errors = $notification->getNotifications();

        $this->assertTrue(!empty($errors) && is_array($errors));
        $this->assertTrue($errors[0] instanceof BootstrapNote);
    }
}
