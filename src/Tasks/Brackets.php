<?php
declare(strict_types=1);

namespace PhpCourse\Tasks;

use InvalidArgumentException;

class Brackets
{
    public function isBalanced(string $str): bool
    {
        $strLength = strlen($str);
        $depth = 0;
        for ($i = 0; $i < $strLength; $i++) {
            switch ($str[$i]) {
                case '(':
                    $depth++;
                    break;
                case ')':
                    $depth--;
                    break;
                default:
                    throw new InvalidArgumentException("Error: String $str should contain only"
                        . " '(' or ')' sybmols, but contains: $str[$i]");
            }
            // Immediately exit with false if closing bracket goes first or after balanced
            if ($depth < 0) return false;
        }
        return $depth === 0;
    }
}
