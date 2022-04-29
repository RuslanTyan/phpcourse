<?php

declare(strict_types=1);

namespace PhpCourse\Tasks;

use InvalidArgumentException;

class AddDigits
{
    public function addDigits(int $num): int
    {
        // Check if argument is >= 0
        if ($num < 0) {
            throw new InvalidArgumentException("Error: the argument {$num} is less than zero");
        }
        // If argument < 10 - it's one digit already and must be returned
        if ($num < 10) {
            return $num;
        }
        // If argument is > 10 its digits should be summarized
        $string = (string)$num; // can be $stringLength = strlen($string = (string) $num);
        $result = 0;
        $stringLength = strlen($string);
        for ($i = 0; $i < $stringLength; $i++) {
            $result += (int)$string[$i];
        }
        return $this->addDigits($result);
    }
}
