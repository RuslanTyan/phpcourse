<?php

declare(strict_types=1);

namespace PhpCourseTests\Tasks;

use ArithmeticError;
use InvalidArgumentException;
use PhpCourse\Logger\FakeLogger;
use PhpCourse\Logger\LoggerInterface;
use PhpCourse\Tasks\Fibonacci;
use PHPUnit\Framework\TestCase;

class FibonacciTest extends TestCase
{
    private function fibMock(): Fibonacci
    {
        return new class extends Fibonacci
        {
            protected static function getLogger(): LoggerInterface
            {
                return new FakeLogger();
            }

            public static function getLoggerLastMessage(): string
            {
                return self::getLogger()->getLastMessage();
            }
        };
    }


    /**
     * @dataProvider fibProvider
     */
    public function testFib(int $index, int $expected): void
    {
        $fibMock = $this->fibMock();
        $fib = $fibMock->fib($index);
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

    public function testFibInvalidInput(): void
    {
        $index = -1;
        $fibMock = $this->fibMock();
        try {
            $fibMock::fib($index);
        } catch (\Throwable $exception) {
            $this->assertInstanceOf(InvalidArgumentException::class, $exception);
            $this->assertEquals("Error: function fib"
                . " accepts only natural integer. \$index = $index was given", $exception->getMessage());
            $this->assertEquals("Error: function fib"
                . " accepts only natural integer. \$index = $index was given", $fibMock::getLoggerLastMessage());
        }

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
