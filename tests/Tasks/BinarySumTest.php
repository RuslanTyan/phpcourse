<?php

declare(strict_types=1);

namespace PhpCourseTests\Tasks;

use InvalidArgumentException;
use PhpCourse\Logger\FakeLogger;
use PHPUnit\Framework\TestCase;
use PhpCourse\Tasks\BinarySum;

class BinarySumTest extends TestCase
{
    /**
     * @dataProvider binarySumWrongInputDataProvider
     */
    public function testBinarySumWrongInputData(string $num1, string $num2): void
    {
        $logger = new FakeLogger();
        $bs = new BinarySum($logger);
        try {
            $bs->binarySum($num1, $num2);
        } catch (\Throwable $exception) {
            $this->assertInstanceOf(InvalidArgumentException::class, $exception);
            $this->assertEquals("Error: Variables \$num1: '{$num1}' and \$num2:"
                . "'{$num2}' must contains only '0' and '1' symbols.\n", $exception->getMessage());
            $this->assertEquals("[ERR] Error: Variables \$num1: '{$num1}' and \$num2:"
                . "'{$num2}' must contains only '0' and '1' symbols.\n", $logger->getLastMessage());
        }
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
        $logger = new FakeLogger();
        self::assertEquals($expected, (new BinarySum($logger))->binarySum($num1, $num2));
        self::assertEquals("[INFO] binarySum result: $expected", $logger->getLastMessage());
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
