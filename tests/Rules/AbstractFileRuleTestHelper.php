<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

use PHPUnit\Framework\TestCase;
use Falgun\Validation\Validator;

class AbstractFileRuleTestHelper extends TestCase
{

    protected Validator $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    protected function performTest(array $files, array $errors)
    {
        $valid = $this->validator->validate([], $files);

        if (empty($errors)) {
            // we are expecting validation true
            $this->assertTrue($valid, 'Valid file has been detected as invalid');
        } else {
            $this->assertFalse($valid, 'Invalid file has been detected as valid');
        }

        $this->assertEquals(
            $errors,
            $this->validator->errors()->all()
        );
    }

    protected function singleFile(): array
    {
        return [
            'name' => 'Screenshot_2020-09-05.csv',
            'type' => 'plain/text',
            'tmp_name' => '/tmp/php45TlTv',
            'size' => 21311,
            'error' => 0,
        ];
    }
}
