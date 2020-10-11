<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class EmailTest extends AbstractRuleTestHelper implements RuleTestInterface
{
    
    public function testBlankData()
    {
        $this->validator->select('email')->email();

        $this->performTest(['email' => ''], ['email' => ['Email' => 'Email should be an email address!']]);
    }

    public function testInvalidData()
    {
        $this->validator->select('email')->email();

        $this->performTest(['email' => 'website@sdfsdf'], ['email' => ['Email' => 'Email should be an email address!']]);
    }

    public function testValidData()
    {
        $this->validator->select('email')->email();

        $this->performTest(['email' => 'email@web.com'], []);
        $this->performTest(['email' => 'name.email@web.com'], []);
    }
}
