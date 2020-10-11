<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class AlphaNumWordsTest extends AbstractRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->select('name')->alphaNumWords();

        $this->performTest(['name' => ''], []);
    }

    public function testInvalidData()
    {
        $this->validator->select('name')->alphaNumWords();

        $this->performTest(['name' => 'ABC & DEF 234'], ['name' => ['AlphaNumWords' => 'Name should only contain letters, numbers and spaces!']]);
        $this->performTest(['name' => 'ABC.'], ['name' => ['AlphaNumWords' => 'Name should only contain letters, numbers and spaces!']]);
    }

    public function testValidData()
    {
        $this->validator->select('name')->alphaNumWords();

        $this->performTest(['name' => 'Falgun 123'], []);
    }
}
