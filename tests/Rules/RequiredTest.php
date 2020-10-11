<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class RequiredTest extends AbstractRuleTestHelper implements RuleTestInterface
{

    public function testInvalidData()
    {
        $this->validator->select('name')->required();

        $this->performTest([], ['name' => ['Required' => 'Name is required!']]);
    }

    public function testBlankData()
    {
        $this->validator->select('name')->required();

        $this->performTest(['name' => ''], ['name' => ['Required' => 'Name is required!']]);
    }

    public function testValidData()
    {
        $this->validator->select('name')->required();

        $this->performTest(['name' => 'Falgun'], []);
    }
}
