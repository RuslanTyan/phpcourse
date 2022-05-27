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
            private static ?FakeLogger $fakeLogger = null;

            protected static function getLogger(): LoggerInterface
            {
                if (self::$fakeLogger === null) {
                    self::$fakeLogger = new FakeLogger();
                }
                return self::$fakeLogger;
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
        $fib = $fibMock::fib($index);
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
            $this->assertEquals("[ERR] Error: function fib"
                . " accepts only natural integer. \$index = $index was given", $fibMock->getLoggerLastMessage());
        }
    }

    /**
     * @dataProvider fibGtMaxIntProvider
     */
    public function testFibGtMaxInt(int $index): void
    {
        $fibMock = $this->fibMock();
        try {
            $fibMock::fib($index);
        } catch (\Throwable $exception) {
            $this->assertInstanceOf(ArithmeticError::class, $exception);
            $this->assertMatchesRegularExpression('/result of fib\(.*\) is greater than maximum integer '
                . 'allowed by the system:' . PHP_INT_MAX . '/', $exception->getMessage());
            $this->assertMatchesRegularExpression('/\[WARN] result of fib\(.* is greater than maximum integer '
                . 'allowed by the system:' . PHP_INT_MAX . '/', $fibMock->getLoggerLastMessage());
        }
    }

    public function fibGtMaxIntProvider(): array
    {
        return [
            [93],
            [100],
        ];
    }
}
