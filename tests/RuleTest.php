<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests;

use PHPUnit\Framework\TestCase;
use Falgun\Validation\Validator;
use Falgun\Validation\Rules\MinLen;

class RuleTest extends TestCase
{

    public function testSetRule()
    {
        $validation = new Validator();

        $validation->select('name')->required()->setRule(new MinLen(2));

        $test1 = $validation->validate(['name' => 'a']);

        $this->assertFalse($test1);
    }
}
