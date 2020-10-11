<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests;

use Falgun\Validation\Validator;
use Falgun\Notification\Nofication;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{

    public function testValidation()
    {
        $validation = new Validator();

        $validation->select('name')->required()->minLen(2)->maxLen(10);

        $valid = $validation->validate(['name' => 'aaa']);

        $this->assertTrue($valid);

        $this->assertEmpty($validation->errors()->all());
    }

    public function testEmptyValidator()
    {
        $validation = new Validator();

        $valid = $validation->validate(['name' => 'aaa']);

        $this->assertTrue($valid);

        $this->assertEmpty($validation->errors()->all());
    }

//    public function testErrorNotification()
//    {
//        $notification = new Notification();
//        $validation = new Validator();
//
//        $validation->select('name')->required();
//        
//        $valid = $validation->validate([]);
//
//        $this->assertFalse($valid);
//
//        $this->assertEquals($validation->errors()->all());
//    }

    public function testLabel()
    {
        $validation = new Validator();

        $validation->select('name')->required();
        $validation->select('main_title')->required();
        $validation->select('second-title')->required();
        $validation->select('status 1')->required();
        $validation->select('category')->label('cat gory')->required();

        $valid = $validation->validate([]);

        $this->assertFalse($valid);

        $this->assertEquals(
            $validation->errors()->all(),
            [
                'name' => ['Required' => 'Name is required!'],
                'main_title' => ['Required' => 'Main Title is required!'],
                'second-title' => ['Required' => 'Second Title is required!'],
                'status 1' => ['Required' => 'Status 1 is required!'],
                'category' => ['Required' => 'Cat Gory is required!'],
            ]
        );
    }

    public function testOptionalValidation()
    {
        $validation = new Validator();

        $validation->select('name')->alphaNum();

        $isValid = $validation->validate([], []);

        $this->assertTrue($isValid, 'Optional Validation Failed');

        $this->assertEquals([], $validation->errors()->all(), 'Optional validation return errors');
    }
}
