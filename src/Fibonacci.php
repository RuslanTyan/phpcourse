<?php
declare(strict_types=1);

namespace PhpCourse\Fibonacci;
$fibonacci = array();

function fib(int $index): ?int
{
    global $fibonacci;

    if ($index < 0) {
        print_r("Error: function fib accepts only natural integer index: $index given");
        return null;
    }
    if (array_key_exists($index, $fibonacci)) {
        return $fibonacci[$index];
    } else {
        if ($index > 1) {
            $fibonacci[$index] = fib($index - 1) + fib($index - 2);
            return $fibonacci[$index];
        }
        if ($index === 1) {
            $fibonacci[$index] = 1;
            return $fibonacci[$index];
        }
        if ($index === 0) {
            $fibonacci[$index] = 0;
            return $fibonacci[$index];
        }
    }
}

function test(int $index): void
{
    var_dump(fib($index));
}

// Tests
test(-1); // null
test(0); // 0
test(1); // 1
test(3); // 2
test(5); // 5
test(10); // 55
test(60); // 1548008755920
