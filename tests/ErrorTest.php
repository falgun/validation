<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests;

use Falgun\Validation\Validator;
use PHPUnit\Framework\TestCase;
use Falgun\Validation\ErrorFormatBag;

final class ErrorTest extends TestCase
{

    public function testErrorArray()
    {
        $validation = new Validator();

        $validation->select('name')->required()->minLen(1)->maxLen(10);

        $valid = $validation->validate([]);

        $this->assertFalse($valid);

        $this->assertEquals(
            $validation->errors()->all(),
            [
                'name' => [
                    'Required' => 'Name is required!',
                    'Min' => 'Name should be atleast 1 characters!',
                    'Max' => 'Name should be within 10 characters!',
                ]
            ]
        );
    }

    public function testErrorIterator()
    {
        $validation = new Validator();

        $validation->select('name')->required();
        $validation->select('email')->required()->email();
        $validation->select('password')->minLen(10);

        $valid = $validation->validate([]);

        $this->assertFalse($valid);

        foreach ($validation->errors() as $item => $error) {
            if ($item === 'name') {
                $this->assertSame(['Required' => 'Name is required!',], $error);
            } elseif ($item === 'email') {
                $this->assertSame([
                    'Required' => 'Email is required!',
                    'Email' => 'Email should be an email address!',
                    ], $error);
            } else {
                $this->fail();
            }
        }
    }

    public function testErrorFormatBag()
    {
        $errorBag = new ErrorFormatBag(
            [
            'Required' => '%s is (test) required!',
            'Min' => '%s should be (test) atleast 1 characters!',
            'Max' => '%s should be (test) within 10 characters!',
            ]
        );
        $validation = new Validator(null, $errorBag);

        $validation->select('name')->required()->minLen(1)->maxLen(10);

        $valid = $validation->validate([]);

        $this->assertFalse($valid);

        $this->assertEquals(
            [
                'name' => [
                    'Required' => 'Name is (test) required!',
                    'Min' => 'Name should be (test) atleast 1 characters!',
                    'Max' => 'Name should be (test) within 10 characters!',
                ]
            ],
            $validation->errors()->all()
        );
    }
}
