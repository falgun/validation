<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests;

use PHPUnit\Framework\TestCase;
use Falgun\Validation\Validator;

class RuleTest extends TestCase
{

    public function testMinLen()
    {
        $validation = new Validator();

        $validation->select('name')->minLen(1);

        $test1 = $validation->validate(['name' => '']);

        $this->assertFalse($test1);
        $this->assertEquals(
            $validation->errors()->all(),
            ['name' => ['Min' => 'Name should be more than 1 characters !']]
        );

        $test2 = $validation->validate(['name' => 'test']);

        $this->assertTrue($test2);
        $this->assertEquals(
            $validation->errors()->all(),
            []
        );
    }

    public function testMaxLen()
    {
        $validation = new Validator();

        $validation->select('name')->maxLen(10);

        $test1 = $validation->validate(['name' => '12345678900']);

        $this->assertFalse($test1);
        $this->assertEquals(
            $validation->errors()->all(),
            ['name' => ['Max' => 'Name should be less than 10 characters !']]
        );

        $test2 = $validation->validate(['name' => 'test']);

        $this->assertTrue($test2);
        $this->assertEquals(
            $validation->errors()->all(),
            []
        );
    }

    public function testCustom()
    {
        $validation = new Validator();

        $validation->select('name')->custom('custom', function($value) {
            return $value;
        });

        $test1 = $validation->validate(['name' => false]);

        $this->assertFalse($test1);
        $this->assertEquals(
            $validation->errors()->all(),
            ['name' => ['custom' => 'Name is invalid!']]
        );

        $test2 = $validation->validate(['name' => true]);

        $this->assertTrue($test2);
        $this->assertEquals(
            $validation->errors()->all(),
            []
        );
    }

    public function testNumeric()
    {
        $validation = new Validator();

        $validation->select('name')->numeric();

        $test1 = $validation->validate(['name' => '']);

        $this->assertFalse($test1);
        $this->assertEquals(
            $validation->errors()->all(),
            ['name' => ['Numeric' => 'Name should be numeric !']]
        );

        $test2 = $validation->validate(['name' => ' 12']);

        $this->assertTrue($test2);
        $this->assertEquals(
            $validation->errors()->all(),
            []
        );
    }

    public function testEmail()
    {
        $validation = new Validator();

        $validation->select('name')->email();

        $failData = ['name' => 'title'];
        $failError = ['name' => ['Email' => 'Name should be an email address !']];
        $successData = ['name' => 'email@site.com'];

        $this->performTest($validation, $failData, $failError, $successData);
    }

    public function testUrl()
    {
        $validation = new Validator();

        $validation->select('name')->url();

        $failData = ['name' => 'title'];
        $failError = ['name' => ['Url' => 'Name should be an url address !']];
        $successData = ['name' => 'https://site.com:8080'];

        $this->performTest($validation, $failData, $failError, $successData);
    }

    public function testIp()
    {
        $validation = new Validator();

        $validation->select('name')->ip();

        $failData = ['name' => 'title'];
        $failError = ['name' => ['Ip' => 'Name should be an IP address !']];
        $successData = ['name' => '127.0.0.1'];

        $this->performTest($validation, $failData, $failError, $successData);
    }

    public function testAlphaNum()
    {
        $validation = new Validator();

        $validation->select('name')->alphaNum();

        $failData = ['name' => 'title!@#$%^&*(sfsdfsdf'];
        $failError = ['name' => ['AlphaNum' => 'Name should only contain letters and numbers !']];
        $successData = ['name' => 'only10'];

        $this->performTest($validation, $failData, $failError, $successData);
    }

    public function testAlphaNumWords()
    {
        $validation = new Validator();

        $validation->select('name')->alphaNumWords();

        $failData = ['name' => 'title!@#$%^&* (sfsdfsdf'];
        $failError = ['name' => ['AlphaNumWords' => 'Name should only contain letters, numbers and spaces !']];
        $successData = ['name' => 'only 10'];

        $this->performTest($validation, $failData, $failError, $successData);
    }

    public function testIsArray()
    {
        $validation = new Validator();

        $validation->select('name')->isArray();

        $failData = ['name' => 'title'];
        $failError = ['name' => ['IsArray' => 'Name should be an array !']];
        $successData = ['name' => ['a', 'b']];

        $this->performTest($validation, $failData, $failError, $successData);
    }

//    public function testMatchWith()
//    {
//        $validation = new Validator();
//
//        $validation->select('name')->matchWith($validation->select('alias'));
//
//        $failData = ['name' => 'john', 'alias' => 'chris'];
//        $failError = ['name' => ['IsArray' => 'Name should match with %s !']];
//        $successData = ['name' => 'john', 'alias' => 'john'];
//
//        $this->performTest($validation, $failData, $failError, $successData);
//    }

    protected function performTest(\Falgun\Validation\Validator $validation, array $failData, array $failError, array $successData)
    {
        $test1 = $validation->validate($failData);

        $this->assertFalse($test1);
        $this->assertEquals(
            $validation->errors()->all(),
            $failError
        );

        $test2 = $validation->validate($successData);

        $this->assertTrue($test2);
        $this->assertEquals(
            $validation->errors()->all(),
            []
        );
    }
}
