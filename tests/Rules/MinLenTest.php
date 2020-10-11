<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class MinLenTest extends AbstractRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->select('name')->minLen(2);

        $this->performTest(['name' => ''], ['name' => ['Min' => 'Name should be atleast 2 characters!']]);
    }

    public function testInvalidData()
    {
        $this->validator->select('name')->minLen(2);

        $this->performTest(['name' => 'a'], ['name' => ['Min' => 'Name should be atleast 2 characters!']]);
    }

    public function testValidData()
    {
        $this->validator->select('name')->minLen(2);

        $this->performTest(['name' => 'Fa'], []);
    }
}
