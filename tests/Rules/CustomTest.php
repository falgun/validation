<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class CustomTest extends AbstractRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->select('name')->custom('custom', function($value) {
            return !empty($value);
        });

        $this->performTest(['name' => ''], ['name' => ['custom' => 'Name is invalid!']]);
    }

    public function testInvalidData()
    {
        $this->validator->select('name')->custom('custom', function($value) {
            return !empty($value);
        });

        $this->performTest(['name' => '0'], ['name' => ['custom' => 'Name is invalid!']]);
    }
    
    public function testCustomErrorMessage()
    {
        $this->validator->select('name')->custom('custom', function($value, $class) {
            $class->setErrorMessage('%s is custom error!');
            return !empty($value);
        });

        $this->performTest(['name' => '0'], ['name' => ['custom' => 'Name is custom error!']]);
    }

    public function testValidData()
    {
        $this->validator->select('name')->custom('custom', function($value) {
            return !empty($value);
        });

        $this->performTest(['name' => 'Falgun'], []);
    }
}
