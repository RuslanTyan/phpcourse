<?php

declare(strict_types=1);

namespace PhpCourseTests\Tasks;

use InvalidArgumentException;
use PhpCourse\Tasks\AddDigits;
use PHPUnit\Framework\TestCase;

class AddDigitsTests extends TestCase
{
    /**
     * @dataProvider addDigitsProvider
     */
    public function testAddDigits(int $num, int $expected): void
    {
        $instance = new AddDigits();
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
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Error: the argument {$num} is less than zero");
        $instance = new AddDigits();
        $instance->addDigits($num);
    }

    public function addDigitsInvalidInputProvider(): array
    {
        return [
            [-1],
            [-PHP_INT_MAX],
        ];
    }
}
