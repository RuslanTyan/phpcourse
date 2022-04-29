<?php

declare(strict_types=1);

namespace PhpCourse\Tasks;

use ArithmeticError;
use InvalidArgumentException;

class Fibonacci
{
    private static array $fibCache = [
        0 => 0,
        1 => 1,
    ];

    public static function fib(int $index): int
    {
        if ($index < 0) {
            throw new InvalidArgumentException("Error: function fib"
                . " accepts only natural integer. \$index = $index was given");
        }
        if (isset(self::$fibCache[$index])) {
            return self::$fibCache[$index];
        }
        $res = self::fib($index - 1) + self::fib($index - 2);
        if (is_int($res)) {
            return self::$fibCache[$index] = $res;
        }
        // If the result not int - this means its value exceeded maximum integer
        throw new ArithmeticError("result of fib($index) is greater than maximum integer "
                . "allowed by the system:" . PHP_INT_MAX . PHP_EOL);
    }
}
