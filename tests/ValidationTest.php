<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests;

use Falgun\Validation\Validator;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{

    public function testValidation()
    {
        $validation = new Validator();
        
        $validation->select('name')->required()->min(2)->max(10);
        
        $valid = $validation->validate(['name' => 'aaa']);
        
        $this->assertTrue($valid);
        
        $this->assertEmpty($validation->errors()->all());
    }
}
