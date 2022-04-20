<?php

declare(strict_types=1);

namespace PhpCourseTests\Tasks;

use PhpCourse\Tasks\FizzBuzz;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    /**
     * @dataProvider fizzBuzzProvider
     */
    public function testFizzBuzz(int $begin, int $end, string $expected): void
    {
        $fizzBuzz = FizzBuzz::fizzBuzzAux($begin, $end);
        self::assertEquals($expected, $fizzBuzz, "Actual:$fizzBuzz" . PHP_EOL);
    }

    public function fizzBuzzProvider(): array
    {
        return [
            [11, 20, '11 Fizz 13 14 FizzBuzz 16 17 Fizz 19 Buzz'],
            [-4, 20,
                '-4 Fizz -2 -1 FizzBuzz 1 2 Fizz 4 Buzz Fizz 7 8 Fizz Buzz 11 Fizz 13 14 FizzBuzz 16 17 Fizz 19 Buzz'],
            [0, 0, 'FizzBuzz'],
            [20, 1, ''],
        ];
    }
}
