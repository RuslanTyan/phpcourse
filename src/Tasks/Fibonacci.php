<?php
declare(strict_types=1);

namespace PhpCourse\Tasks;

use InvalidArgumentException;

class Fibonacci
{
    public static function fib(int $index): int
    {
        if ($index < 0) {
            throw new InvalidArgumentException("Error: function fib accepts only natural integer. \$index = $index was given");
        }

        static $fibCache = [
            0 => 0,
            1 => 1,
        ];

        if (array_key_exists($index, $fibCache)) {
            return $fibCache[$index];
        }
        return $fibCache[$index] = Fibonacci::fib($index - 1) + Fibonacci::fib($index - 2);
    }
}
