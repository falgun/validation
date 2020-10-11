<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class AlphaNumTest extends AbstractRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->select('name')->alphaNum();

        $this->performTest(['name' => ''], ['name' => ['AlphaNum' => 'Name should only contain letters and numbers!']]);
    }

    public function testInvalidData()
    {
        $this->validator->select('name')->alphaNum();

        $this->performTest(['name' => 'ABC DEF 234'], ['name' => ['AlphaNum' => 'Name should only contain letters and numbers!']]);
        $this->performTest(['name' => 'ABC.'], ['name' => ['AlphaNum' => 'Name should only contain letters and numbers!']]);
    }

    public function testValidData()
    {
        $this->validator->select('name')->alphaNum();

        $this->performTest(['name' => 'Falgun123'], []);
    }
}
