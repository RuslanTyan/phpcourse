<?php

declare(strict_types=1);

namespace PhpCourse\Tasks;

class PowerOfThree
{
    public function isPowerOfThree(int $num): bool
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
}
