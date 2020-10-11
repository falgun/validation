<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class RequiredFileTest extends AbstractFileRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->file('photo')->required();

        $this->performTest(['photo' => ''], ['photo' => ['RequiredFile' => 'Photo is required!']]);
    }

    public function testInvalidData()
    {
        $this->validator->file('photo')->required();

        $this->performTest(['photo' => ['error' => 4]], ['photo' => ['RequiredFile' => 'Photo is required!']]);
    }

    public function testValidData()
    {
        $this->validator->file('photo')->required();

        $this->performTest(['photo' => ['error' => 0]], []);
    }
}
