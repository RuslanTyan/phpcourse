<?php
declare(strict_types=1);

namespace PhpCourse\PerfectNumber;

function isPerfect(int $num): bool
{
    if ($num < 2) {
        return false;
    }
    $half = ceil($num / 2);
    $divisors = [1];
    for ($i = 2; $i <= $half; $i++) {
        if ($num % $i === 0) {
            $divisors[] = $i;
        }
    }
    $sum = 0;
    foreach ($divisors as $val) {
        $sum += $val;
    }
    if ($num === $sum) {
        echo "$num is perfect\n";
        return true;
    }
    return false;
}

//Tests
isPerfect(-1);
isPerfect(0);
isPerfect(1);
isPerfect(3);
isPerfect(6);
isPerfect(27);
isPerfect(28);
isPerfect(496);
isPerfect(8128);
isPerfect(33550336);
//isPerfect(8589869056); true but too long
