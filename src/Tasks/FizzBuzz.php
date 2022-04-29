<?php

declare(strict_types=1);

namespace PhpCourse\Tasks;

class FizzBuzz
{
    public function fizzBuzz(int $begin, int $end): void
    {
        echo self::fizzBuzzAux($begin, $end);
    }

    public static function fizzBuzzAux(int $begin, int $end): string
    {
        $string = '';
        for ($i = $begin; $i <= $end; $i++) {
            $isTripled = $i % 3 === 0;
            $isFifled = $i % 5 === 0;
            if ($isTripled) {
                $string .= "Fizz";
            }
            if ($isFifled) {
                $string .= "Buzz";
            }
            if (!($isTripled || $isFifled)) {
                $string .= $i;
            }
            if ($i === $end) {
                break;
            }
            $string .= ' ';
        }
        return $string;
    }
}
