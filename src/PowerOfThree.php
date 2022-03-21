<?php
declare(strict_types=1);

namespace PhpCourse\PowerOfThree;

function isPowerOfThree(int $num): bool
{
    if ($num < 1) {
        // The lowest "natural" power of 3 is 1
        return false;
    }
    $i = 0;
    do {
        $result = 3 ** $i++;
        if ($result === $num) {
            return true;
        }
    } while ($result < $num);
    return false;
}

// Tests:
function test(int $num): void
{
     echo "The number $num is " . (isPowerOfThree($num) ? '' : 'not ') . "natural power of 3\n";
}

test(-1); // false
test(0); // false
test(1); // true
test(2); // false
test(3); // true
test(4); // false
test(9); // true
test(27); // true
test(81); // true
test(PHP_INT_MAX); // false
