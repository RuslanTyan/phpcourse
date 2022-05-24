<?php

declare(strict_types=1);

namespace PhpCourseTests\Tasks;

use InvalidArgumentException;
use PhpCourse\Logger\FakeLogger;
use PhpCourse\Tasks\AddDigits;
use PHPUnit\Framework\TestCase;

class AddDigitsTest extends TestCase
{
    /**
     * @dataProvider addDigitsProvider
     */
    public function testAddDigits(int $num, int $expected): void
    {
        $logger = new FakeLogger();
        $instance = new AddDigits($logger);
        self::assertEquals($expected, $instance->addDigits($num));
    }

    public function addDigitsProvider(): array
    {
        return [
            [0, 0],
            [1, 1],
            [9, 9],
            [10, 1],
            [38, 2],
            [PHP_INT_MAX, 7],
        ];
    }

    /**
     * @dataProvider addDigitsInvalidInputProvider
     */
    public function testAddDigitsInvalidInput(int $num): void
    {
        $logger = new FakeLogger();
        $instance = new AddDigits($logger);
        try {
            $instance->addDigits($num);
        } catch (\Throwable $exception) {
            $this->assertInstanceOf(InvalidArgumentException::class, $exception);
            $this->assertEquals("Error: the argument {$num} is less than zero", $exception->getMessage());
            $this->assertEquals("[ERR]Error: the argument {$num} is less than zero", $logger->getLastMessage());
        }
    }

    public function addDigitsInvalidInputProvider(): array
    {
        return [
            [-1],
            [-PHP_INT_MAX],
        ];
    }
}
