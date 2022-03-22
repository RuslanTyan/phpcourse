<?php
declare(strict_types=1);

namespace PhpCourse\Fibonacci;

function fib(int $index): ?int
{
    if ($index < 0) {
        print_r("Error: function fib accepts only natural integer. \$index = $index was given");
        return null;
    }
    switch ($index) {
        case 0:
            return 0;
        case 1:
            return 1;
        default:
            return fib($index - 1) + fib($index - 2);
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
// Hangs w/o optimization:
// test(60); // 1548008755920
