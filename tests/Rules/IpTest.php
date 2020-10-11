<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class IpTest extends AbstractRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->select('ip')->ip();

        $this->performTest(['ip' => ''], ['ip' => ['Ip' => 'Ip should be an IP address!']]);
    }

    public function testInvalidData()
    {
        $this->validator->select('ip')->ip();

        $this->performTest(['ip' => '12.7.354'], ['ip' => ['Ip' => 'Ip should be an IP address!']]);
    }

    public function testValidData()
    {
        $this->validator->select('ip')->ip();

        $this->performTest(['ip' => '127.0.0.1'], []);
    }
}
