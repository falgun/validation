<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class MatchWithTest extends AbstractRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->select('name')->matchWith($this->validator->select('alias'));

        $this->performTest(['name' => '', 'alias' => ''], []);
    }

    public function testInvalidData()
    {
        $this->validator->select('name')->matchWith($this->validator->select('alias'));

        $this->performTest(['name' => 'john', 'alias' => 'chris'],
            ['alias' => ['MatchWith' => 'Alias should contain same value as Name!']]
        );
    }

    public function testWeakTypeData()
    {
        $this->validator->select('name')->matchWith($this->validator->select('alias'));

        $this->performTest(['name' => 0, 'alias' => '0'],
            ['alias' => ['MatchWith' => 'Alias should contain same value as Name!']]
        );
    }

    public function testValidData()
    {
        $this->validator->select('name')->matchWith($this->validator->select('alias'));

        $this->performTest(['name' => 'john', 'alias' => 'john'], []);
    }
}
