<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class NumericTest extends AbstractRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->select('score')->numeric();

        $this->performTest(['score' => ''], ['score' => ['Numeric' => 'Score should be numeric!']]);
    }

    public function testInvalidData()
    {
        $this->validator->select('score')->numeric();

        $this->performTest(['score' => 'aaa'], ['score' => ['Numeric' => 'Score should be numeric!']]);
    }

    public function testValidData()
    {
        $this->validator->select('score')->numeric();

        $this->performTest(['score' => ' 12'], []);
        $this->performTest(['score' => 12], []);
    }
}
