<?php

declare(strict_types=1);

namespace PhpCourse\Tasks;

use ArithmeticError;
use InvalidArgumentException;
use PhpCourse\Logger\LoggerInterface;
use PhpCourse\Logger\StaticLoggerFactory;

class Fibonacci
{
    private static ?LoggerInterface $logger = null;

    protected static function getLogger(): LoggerInterface
    {
        if (self::$logger === null) {
            self::$logger = (new StaticLoggerFactory())->getLogger();
        }
        return self::$logger;
    }

    private static array $fibCache = [
        0 => 0,
        1 => 1,
    ];

    public static function fib(int $index): int
    {
        if ($index < 0) {
            self::getLogger()->err("Error: function fib"
                . " accepts only natural integer. \$index = $index was given");
            throw new InvalidArgumentException("Error: function fib"
                . " accepts only natural integer. \$index = $index was given");
        }
        if (isset(self::$fibCache[$index])) {
            return self::$fibCache[$index];
        }
        $res = self::fib($index - 1) + self::fib($index - 2);
        if (is_int($res)) {
            self::getLogger()->info("fib($index)=$res");
            return self::$fibCache[$index] = $res;
        }
        // If the result not int - this means its value exceeded maximum integer
        self::getLogger()->warn("result of fib($index) = $res is greater than maximum integer "
            . "allowed by the system:" . PHP_INT_MAX);
        throw new ArithmeticError("result of fib($index) is greater than maximum integer "
                . "allowed by the system:" . PHP_INT_MAX . PHP_EOL);
    }
}
