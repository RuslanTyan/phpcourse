<?php
declare(strict_types=1);

namespace PhpCourse\Tasks;

class FizzBuzz
{
    public function fizzBuzz(int $begin, int $end): void
    {
        if ($end < $begin) {
            return;
        }
        for ($i = $begin; ; $i++) {
            if ($this->isTripled($i)) {
                echo "Fizz";
            }
            if ($this->isFifled($i)) {
                echo "Buzz";
            }
            if (!($this->isTripled($i) || $this->isFifled($i))) {
                echo $i;
            }
            if ($i >= $end) {
                break;
            }
            echo " ";
        }
    }

    private function isTripled(int $num): bool
    {
        return $num % 3 === 0;
    }

    private function isFifled(int $num): bool
    {
        return $num % 5 === 0;
    }
}
