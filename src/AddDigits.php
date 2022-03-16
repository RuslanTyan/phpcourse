<?php
declare(strict_types=1);

namespace PhpCourse\AddDigits;

function addDigits(int $num): ?int
{
    // Check if argument is >= 0
    if ($num < 0) {
        print_r("Error: the argument is less than zero");
        return null;
    }
    // If argument < 10 - it's one digit already and must be returned
    if ($num < 10) {
        return $num;
    }
    // If argument is > 10 its digits should be summarized
    $string = (string) $num; // can be $stringLength = strlen($string = (string) $num);
    $result = 0;
    $stringLength = strlen($string);
    for ($i = 0; $i < $stringLength; $i++) {
        $result += (int) $string[$i];
    }
    return addDigits($result);
}

// Tests
var_dump(addDigits(-1));
var_dump(addDigits(0));
var_dump(addDigits(1));
var_dump(addDigits(9));
var_dump(addDigits(10));
var_dump(addDigits(38));
