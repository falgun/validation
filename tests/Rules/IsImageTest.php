<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests\Rules;

final class IsImageTest extends AbstractFileRuleTestHelper implements RuleTestInterface
{

    public function testBlankData()
    {
        $this->validator->file('photo')->isImage();

        $this->performTest(['photo' => []], ['photo' => ['IsImage' => 'Photo should be an image file!']]);
    }

    public function testInvalidData()
    {
        $this->validator->file('photo')->isImage();

        $photo = ['photo' =>
            [
                [
                    'name' => 'Screenshot_2020-09-05.png',
                    'type' => 'image/png',
                    'tmp_name' => '/tmp/php45TlTv',
                    'size' => 21311,
                    'error' => 0,
                ],
                $this->singleFile(),
            ],
        ];

        $this->performTest($photo, ['photo' => ['IsImage' => 'Photo should be an image file!']]);
    }

    public function testValidData()
    {
        $this->validator->file('photo')->isImage();

        $photos = [
            'photo' => [
                [
                    'name' => 'Screenshot_2020-09-05.png',
                    'type' => 'image/png',
                    'tmp_name' => '/tmp/php45TlTv',
                    'size' => 21311,
                    'error' => 0,
                ],
                [
                    'name' => 'Screenshot_2020-09-05.JPG',
                    'type' => 'image/jpg',
                    'tmp_name' => '/tmp/php45TlTv',
                    'size' => 21311,
                    'error' => 0,
                ],
                [
                    'name' => 'Screenshot_2020-09-05.jpeg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/php45TlTv',
                    'size' => 21311,
                    'error' => 0,
                ],
                [
                    'name' => 'Screenshot_2020-09-05.gif',
                    'type' => 'image/gif',
                    'tmp_name' => '/tmp/php45TlTv',
                    'size' => 21311,
                    'error' => 0,
                ],
                [
                    'name' => 'Screenshot_2020-09-05.WebP',
                    'type' => 'image/webp',
                    'tmp_name' => '/tmp/php45TlTv',
                    'size' => 21311,
                    'error' => 0,
                ],
            ]
        ];

        $this->performTest($photos, []);
    }
}
