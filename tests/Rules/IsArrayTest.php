<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class IsArrayTest extends AbstractRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->select('values')->isArray();

        $this->performTest(['values' => ''], ['values' => ['IsArray' => 'Values should be an array!']]);
    }

    public function testInvalidData()
    {
        $this->validator->select('values')->isArray();

        $this->performTest(['values' => '345'], ['values' => ['IsArray' => 'Values should be an array!']]);
    }

    public function testValidData()
    {
        $this->validator->select('values')->isArray();

        $this->performTest(['values' => []], []);
    }
}
