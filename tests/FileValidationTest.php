<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests;

use Falgun\Validation\Validator;
use PHPUnit\Framework\TestCase;
use Falgun\Http\Parameters\Files;
use Falgun\Http\Parameters\File;

class FileValidationTest extends TestCase
{

    public function testFileValidation()
    {
        $validation = new Validator();

        $validation->file('file_1')->required()->isImage();
        $validation->file('file_2')->required()->multipleFile()->isImage();

        $files = [
            'file_1' => [
                'name' => 'Screenshot_2020-09-05.png',
                'type' => 'image/png',
                'tmp_name' => '/tmp/php45TlTv',
                'size' => 21311,
                'error' => 0,
            ],
            'file_2' => [
                [
                    'name' => 'Screenshot_2020-09-05.png',
                    'type' => 'image/png',
                    'tmp_name' => '/tmp/php45TlTv',
                    'size' => 21311,
                    'error' => 0,
                ],
                [
                    'name' => 'Screenshot_2020-09-29.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/phpDpuExs',
                    'size' => 14234,
                    'error' => 0,
                ],
            ],
        ];

        $isValid = $validation->validate([], $files);

        $this->assertTrue($isValid, 'File Validation Failed');

        $this->assertEquals([], $validation->errors()->all(), 'File validation return errors');
    }

    public function testImageFileValidation()
    {
        $files = [
            'file_1' => [
                'name' => 'Screenshot_2020-09-05.csv',
                'type' => 'plain/text',
                'tmp_name' => '/tmp/php45TlTv',
                'size' => 21311,
                'error' => 0,
            ],
        ];

        $validation = new Validator();

        $validation->file('file_1')->required()->isImage();

        $isValid = $validation->validate([], $files);

        $this->assertFalse($isValid, 'Image File Validation Failed');

        $this->assertEquals(['file_1' => ['IsImage' => 'File 1 should be an image file!']],
            $validation->errors()->all(),
            'Image File validation return errors');
    }

    public function testMultipleFileValidation()
    {
        $files = [
            'file_1' => [
                'name' => 'Screenshot_2020-09-05.csv',
                'type' => 'plain/text',
                'tmp_name' => '/tmp/php45TlTv',
                'size' => 21311,
                'error' => 0,
            ],
        ];

        $validation = new Validator();

        $validation->file('file_1')->required()->multipleFile();

        $isValid = $validation->validate([], $files);

        $this->assertFalse($isValid, 'Multiple File Validation Failed');

        $this->assertEquals(['file_1' => ['MultipleFile' => 'File 1 should have multiple files !']],
            $validation->errors()->all(),
            'Multiple File validation return errors');
    }

    public function testEmptyFileValidation()
    {
        $files = [
            'file_1' => [
                'name' => '',
                'type' => '',
                'tmp_name' => '',
                'size' => 0,
                'error' => 4,
            ],
            'file_2' => [
                [
                    'name' => '',
                    'type' => '',
                    'tmp_name' => '',
                    'size' => 0,
                    'error' => 4,
                ],
            ],
        ];

        $validation = new Validator();

        $validation->file('file_1')->required();
        $validation->file('file_2')->multipleFile()->isImage();

        $isValid = $validation->validate([], $files);

        $this->assertFalse($isValid, 'Multiple File Validation Failed');

        $this->assertEquals(
            [
                'file_1' => ['RequiredFile' => 'File 1 is required!'],
            ],
            $validation->errors()->all(),
            'Multiple File validation return errors');
    }

    public function testFileSizeValidation()
    {

        $validation = new Validator();

        $validation->file('file_1')->maxSize(500);
        $validation->file('file_2')->maxSize(500);

        ////// Success Case ////////
        $files = [
            'file_1' => [
                'name' => 'Screenshot_2020-09-05.png',
                'type' => 'image/png',
                'tmp_name' => '/tmp/php45TlTv',
                'size' => 213,
                'error' => 0,
            ],
            'file_2' => [
                [
                    'name' => 'Screenshot_2020-09-05.png',
                    'type' => 'image/png',
                    'tmp_name' => '/tmp/php45TlTv',
                    'size' => 213,
                    'error' => 0,
                ],
                [
                    'name' => 'Screenshot_2020-09-29.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/phpDpuExs',
                    'size' => 142,
                    'error' => 0,
                ],
            ],
        ];

        $isValid = $validation->validate([], $files);

        $this->assertTrue($isValid, 'File Size Success Validation Failed');

        $this->assertEquals([], $validation->errors()->all(), 'File Size Success validation return errors');
        ///// Success case end ////
        ///// Failed case ////
        $files = [
            'file_1' => [
                'name' => 'Screenshot_2020-09-05.png',
                'type' => 'image/png',
                'tmp_name' => '/tmp/php45TlTv',
                'size' => 21311,
                'error' => 0,
            ],
            'file_2' => [
                [
                    'name' => 'Screenshot_2020-09-05.png',
                    'type' => 'image/png',
                    'tmp_name' => '/tmp/php45TlTv',
                    'size' => 21311,
                    'error' => 0,
                ],
                [
                    'name' => 'Screenshot_2020-09-29.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/tmp/phpDpuExs',
                    'size' => 14234,
                    'error' => 0,
                ],
            ],
        ];

        $isValid = $validation->validate([], $files);

        $this->assertFalse($isValid, 'File Size Fail Validation Failed');

        $this->assertEquals(
            [
                'file_1' => ['MaxFileSize' => 'File 1 should be less than 500 bytes!'],
                'file_2' => ['MaxFileSize' => 'File 2 should be less than 500 bytes!']
            ],
            $validation->errors()->all(),
            'File Size Fail validation return errors');
    }
}
