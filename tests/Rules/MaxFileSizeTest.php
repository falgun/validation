<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class MaxFileSizeTest extends AbstractFileRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->file('photos')->maxSize(500);

        $this->performTest(['photos' => []], ['photos' => ['MaxFileSize' => 'Photos should be less than 500 bytes!']]);
    }

    public function testInvalidData()
    {
        $this->validator->file('photos')->maxSize(500);

        $this->performTest(['photos' => [['size' => 299], ['size' => 501]]], ['photos' => ['MaxFileSize' => 'Photos should be less than 500 bytes!']]);
    }

    public function testValidData()
    {
        $this->validator->file('photos')->maxSize(500);

        $this->performTest(['photos' => ['size' => 500]], []);
        $this->performTest(['photos' => ['error' => 4]], []);
    }
}
