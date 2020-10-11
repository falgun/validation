<?php
declare(strict_types=1);

namespace Falgun\Validation\Tests;

use Falgun\Validation\Validator;
use PHPUnit\Framework\TestCase;
use Falgun\Validation\Rules\MultipleFile;

final class FileRuleTest extends TestCase
{

    private function singleFile(): array
    {
        return [
            'name' => 'Screenshot_2020-09-05.csv',
            'type' => 'plain/text',
            'tmp_name' => '/tmp/php45TlTv',
            'size' => 21311,
            'error' => 0,
        ];
    }

    public function testSetRule()
    {
        $validation = new Validator();

        $validation->file('photo')->required()->setRule(new MultipleFile());

        $test1 = $validation->validate([], ['photo' => $this->singleFile()]);

        $this->assertFalse($test1);
    }

    public function testCustom()
    {
        $files = [
            'file_1' => [
                'name' => 'Screenshot_2020-09-05.csv',
                'type' => 'plain/text',
                'tmp_name' => '/tmp/php45TlTv',
                'size' => 21311,
                'error' => 1,
            ],
        ];

        $validation = new Validator();

        $validation->file('file_1')->required()->custom('custom', function($value): bool {
            if ($value === null) {
                return false;
            }

            return $value['error'] === 0;
        });

        $test1 = $validation->validate([], $files);

        $this->assertFalse($test1);
        $this->assertEquals(
            ['file_1' =>
                [
                    'RequiredFile' => 'File 1 is required!',
                    'custom' => 'File 1 is invalid!',
                ]
            ],
            $validation->errors()->all()
        );

        $files['file_1']['error'] = 0;
        $test2 = $validation->validate([], $files);

        $this->assertTrue($test2);
        $this->assertEquals([], $validation->errors()->all());
    }
}
