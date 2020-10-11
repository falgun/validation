<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class UrlTest extends AbstractRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->select('url')->url();

        $this->performTest(['url' => ''], ['url' => ['Url' => 'Url should be an url address!']]);
    }

    public function testInvalidData()
    {
        $this->validator->select('url')->url();

        $this->performTest(['url' => 'sfsdf.cvom'], ['url' => ['Url' => 'Url should be an url address!']]);
        $this->performTest(['url' => '//site.com'], ['url' => ['Url' => 'Url should be an url address!']]);
    }

    public function testValidData()
    {
        $this->validator->select('url')->url();

        $this->performTest(['url' => 'http://site.com/'], []);
    }
}
