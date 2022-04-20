<?php

declare(strict_types=1);

namespace PhpCourseTests\Tasks;

use ArithmeticError;
use InvalidArgumentException;
use PhpCourse\Tasks\BinarySumViaInt;
use PHPUnit\Framework\TestCase;
use RangeException;

class BinarySumViaIntTest extends TestCase
{
    /**
     * @dataProvider binarySumWrongInputDataProvider
     */
    public function testBinarySumWrongInputData(string $num1, string $num2): void
    {
        $bsvi = new BinarySumViaInt();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Error: Variables \$num1: '{$num1}' and \$num2:"
            . "'{$num2}' must contains only '0' and '1' symbols.\n");
        $bsvi->binarySum($num1, $num2);
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
     * @dataProvider binarySumOutOfRangeAgrumentsProvider
     */
    public function testBinarySumOutOfRangeAgruments(string $num1, string $num2): void
    {
        $bsvi = new BinarySumViaInt();
        $maxSystemBin = decbin(PHP_INT_MAX);
        $this->expectException(RangeException::class);
        $this->expectExceptionMessage("Error: Absolut values of arguments: \$num1: '{$num1}'" .
            " and \$num2:'{$num2}' must not be greater than max allowed by system: $maxSystemBin\n");
        $bsvi->binarySum($num1, $num2);
    }

    public function binarySumOutOfRangeAgrumentsProvider(): array
    {
        return [
            [decbin(PHP_INT_MAX) . '00', '0'], //add double 0 because single 0 converts to negative binary only
            ['0', decbin(-PHP_INT_MAX) . '0'],
            [decbin(PHP_INT_MAX) . '00', decbin(-PHP_INT_MAX) . '0'],
        ];
    }

    /**
     * @dataProvider binarySumOutOfRangeResultProvider
     */
    public function testBinarySumOutOfRangeResult(string $num1, string $num2, int $num1dec, int $num2dec): void
    {
        $bsvi = new BinarySumViaInt();
        $this->expectException(ArithmeticError::class);
        $resultDec = $num1dec + $num2dec;
        $this->expectExceptionMessage("Summ of the arguments: {$num1dec} and {$num2dec}"
            . " is greater than maximum allowed integer in the system."
            . "Summ:{$resultDec}\n");
        $bsvi->binarySum($num1, $num2);
    }

    public function binarySumOutOfRangeResultProvider(): array
    {
        return [
            [decbin(PHP_INT_MAX), decbin(PHP_INT_MAX - 1), PHP_INT_MAX, PHP_INT_MAX - 1],
            [decbin(-PHP_INT_MAX), decbin(-PHP_INT_MAX + 1), -PHP_INT_MAX, -PHP_INT_MAX + 1],
        ];
    }

    /**
     * @dataProvider binarySumProvider
     */
    public function testBinarySum(string $num1, string $num2, string $expected): void
    {
        self::assertEquals($expected, (new BinarySumViaInt())->binarySum($num1, $num2));
    }

    public function binarySumProvider(): array
    {
        return [
            ['0', '0', '0'],
            ['1', '1', '10'],
            ['01', '001', '10'],
            ['000001', '000100000', '100001'],
            [decbin(PHP_INT_MAX), decbin(-PHP_INT_MAX), '0'],
        ];
    }
}
