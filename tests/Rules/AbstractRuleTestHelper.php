<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

use PHPUnit\Framework\TestCase;
use Falgun\Validation\Validator;

class AbstractRuleTestHelper extends TestCase
{

    protected Validator $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    protected function performTest(array $input, array $errors)
    {
        $valid = $this->validator->validate($input);

        if (empty($errors)) {
            // we are expecting validation true
            $this->assertTrue($valid, 'Valid input has been detected as invalid');
        } else {
            $this->assertFalse($valid, 'Invalid input has been detected as valid');
        }

        $this->assertEquals(
            $errors,
            $this->validator->errors()->all()
        );
    }
}
