<?php

namespace Falgun\Validation\Tests\Rules;

interface RuleTestInterface
{

    public function testValidData();

    public function testInvalidData();

    public function testBlankData();
}
