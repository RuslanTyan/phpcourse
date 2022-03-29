<?php
declare(strict_types=1);

namespace PhpCourse\Tasks;

class PerfectNumber
{
    public function isPerfect(int $num): bool
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
        return $num === $sum;
    }
}
