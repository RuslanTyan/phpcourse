<?php

declare(strict_types=1);

namespace PhpCourseTests\Tasks;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PhpCourse\Tasks\BinarySum;

class BinarySumTest extends TestCase
{
    /**
     * @dataProvider binarySumWrongInputDataProvider
     */
    public function testBinarySumWrongInputData(string $num1, string $num2): void
    {
        $bs = new BinarySum();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Error: Variables \$num1: '{$num1}' and \$num2:"
            . "'{$num2}' must contains only '0' and '1' symbols.\n");
        $bs->binarySum($num1, $num2);
    }

    public function binarySumWrongInputDataProvider(): array
    {
        return [
            ['-1', '1'],
            ['', '1'],
            ['0', ''],
            ['1', 'x'],
            ['', ''],
        ];
    }

    /**
     * @dataProvider binarySumProvider
     */
    public function testBinarySum(string $num1, string $num2, string $expected): void
    {
        self::assertEquals($expected, (new BinarySum())->binarySum($num1, $num2));
    }

    public function binarySumProvider(): array
    {
        return [
            ['0', '0', '0'],
            ['1', '1', '10'],
            [
                '111111111111111111111111111111111111111111111111111111111111111',
                '111111111111111111111111111111111111111111111111111111111111111',
                '1111111111111111111111111111111111111111111111111111111111111110',
            ],
            ['01', '001', '10'],
            ['000001', '000100000', '100001'],
        ];
    }
}
