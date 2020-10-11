<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class MaxLenTest extends AbstractRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->select('name')->maxLen(2);

        $this->performTest(['name' => ''], []);
    }

    public function testInvalidData()
    {
        $this->validator->select('name')->maxLen(2);

        $this->performTest(['name' => 'aaa'], ['name' => ['Max' => 'Name should be within 2 characters!']]);
    }

    public function testValidData()
    {
        $this->validator->select('name')->maxLen(2);

        $this->performTest(['name' => 'Fa'], []);
    }
}
