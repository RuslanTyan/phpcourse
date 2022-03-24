<?php
declare(strict_types=1);

namespace PhpCourse\FizzBuzz;

function fizzBuzz(int $begin, int $end): void
{
    if ($end < $begin) {
        return;
    }
    for ($i = $begin; $i <= $end; $i++) {
        if (isTripled($i)) {
            echo "Fizz";
        }
        if (isFifled($i)) {
            echo "Buzz";
        }
        if (!(isTripled($i) || isFifled($i))) {
            echo $i;
        }
        echo " ";
    }
}

function isTripled(int $num): bool
{
    return ($num % 3 === 0);
}

function isFifled(int $num): bool
{
    return ($num % 5 === 0);
}

// Tests
fizzBuzz(11,20);
