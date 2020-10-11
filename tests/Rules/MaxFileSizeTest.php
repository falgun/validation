<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class MaxFileSizeTest extends AbstractFileRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->file('photos')->maxSize(500);

        $this->performTest(['photos' => []], ['photos' => ['MaxFileSize' => 'Photos should be less than 500 bytes!']]);
    }

    public function testInvalidData()
    {
        $this->validator->file('photos')->maxSize(500);

        $this->performTest(['photos' => [['size' => 299], ['size' => 501]]], ['photos' => ['MaxFileSize' => 'Photos should be less than 500 bytes!']]);
    }

    public function testInvalidInMultipleData()
    {
        $this->validator->file('photos')->maxSize(200);
        $photos = ['photos' =>
            [
                [
                    'name' => 'Screenshot_2020-09-05.png',
                    'type' => 'image/png',
                    'tmp_name' => '/tmp/php45TlTv',
                    'size' => 199,
                    'error' => 0,
                ],
                [
                    'name' => 'Screenshot_2020-09-05.jpeg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php45TlTv',
                    'size' => 201,
                    'error' => 0,
                ],
                [
                    'name' => 'Screenshot_2020-09-05.gif',
                    'type' => 'image/gif',
                    'tmp_name' => '/tmp/php45TlTv',
                    'size' => 200,
                    'error' => 0,
                ],
            ],
        ];

        $this->performTest(
            $photos,
            ['photos' => ['MaxFileSize' => 'Photos should be less than 200 bytes!']]
        );
    }

    public function testValidData()
    {
        $this->validator->file('photos')->maxSize(500);

        $this->performTest(['photos' => ['size' => 500]], []);
        $this->performTest(['photos' => ['error' => 4]], []);
    }
}
