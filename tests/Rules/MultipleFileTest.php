<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class MultipleFileTest extends AbstractFileRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->file('photos')->multipleFile();

        $this->performTest(['photos' => []], ['photos' => ['MultipleFile' => 'Photos should have multiple files!']]);
    }

    public function testInvalidData()
    {
        $this->validator->file('photos')->multipleFile();

        $this->performTest(['photos' => $this->singleFile()], ['photos' => ['MultipleFile' => 'Photos should have multiple files!']]);
    }

    public function testValidData()
    {
        $this->validator->file('photos')->multipleFile();

        $this->performTest([
            'photos' => [[$this->singleFile()], [$this->singleFile()]]
            ],
            []);
    }
}
