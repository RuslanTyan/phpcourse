<?php

declare(strict_types=1);

namespace PhpCourseTests\Tasks;

use ArithmeticError;
use InvalidArgumentException;
use PhpCourse\Tasks\Fibonacci;
use PHPUnit\Framework\TestCase;

class FibonacciTest extends TestCase
{
    /**
     * @dataProvider fibProvider
     */
    public function testFib(int $index, int $expected): void
    {
        $fib = Fibonacci::fib($index);
        self::assertEquals($expected, $fib, "$expected no equal actual: $fib" . PHP_EOL);
    }

    public function fibProvider(): array
    {
        return [
            [0, 0],
            [1, 1],
            [2, 1],
            [5, 5],
            [10, 55],
            [60, 1548008755920],
            [92, 7540113804746346429],
        ];
    }

    /**
     * @dataProvider fibInvalidInputProvider
     */
    public function testFibInvalidInput(int $index): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Error: function fib"
            . " accepts only natural integer. \$index = $index was given");
        Fibonacci::fib($index);
    }

    public function fibInvalidInputProvider(): array
    {
        return [
            [-1],
        ];
    }

    /**
     * @dataProvider fibGtMaxIntProvider
     */
    public function testFibGtMaxInt(int $index): void
    {
        $this->expectException(ArithmeticError::class);
        $this->expectExceptionMessage("is greater than maximum integer "
            . "allowed by the system:" . PHP_INT_MAX);
        Fibonacci::fib($index);
    }

    public function fibGtMaxIntProvider(): array
    {
        return [
            [93],
            [100],
        ];
    }
}
