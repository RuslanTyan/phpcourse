<?php

declare(strict_types=1);

namespace PhpCourse\Tasks;

use ArithmeticError;
use InvalidArgumentException;
use RangeException;

class BinarySumViaInt
{
    public function binarySum(string $num1, string $num2): string
    {
        // Check only allowed symbols '0' or '1' are passed to variables
        if (!$this->isBinaryString($num1) || !$this->isBinaryString($num2)) {
            throw new InvalidArgumentException("Error: Variables \$num1: '{$num1}' and \$num2:"
                . "'{$num2}' must contains only '0' and '1' symbols.\n");
        }

        // Check arguments are less than can be safely converted to integer abs($arg) <= PHP_INT_MAX
        if ($this->isMaxSizeExceeded($num1) || $this->isMaxSizeExceeded($num2)) {
            $maxSystemBin = decbin(PHP_INT_MAX);
            throw new RangeException("Error: Absolut values of arguments: \$num1: '{$num1}'" .
                " and \$num2:'{$num2}' must not be greater than max allowed by system: $maxSystemBin\n");
        }

        // Convert to integers before summ
        $num1dec = $this->strictBinDec($num1);
        $num2dec = $this->strictBinDec($num2);

        // Summ the integers
        $resultDec = $num1dec + $num2dec;
        if (is_int($resultDec)) {
            return decbin($resultDec);
        }
        throw new ArithmeticError("Summ of the arguments: {$num1dec} and {$num2dec}"
            . " is greater than maximum allowed integer in the system."
            . "Summ:{$resultDec}\n");
    }

    private function isBinaryString(string $str): bool
    {
        return ($str !== '') && (str_replace(['0', '1'], '', $str) === '');
    }

    private function isMaxSizeExceeded(string $str): bool
    {
        // Maximum integer in binary
        $systemBitsNum = strlen(decbin(PHP_INT_MAX)) + 1;
        return strlen($str) > $systemBitsNum;
    }

    private function strictBinDec(string $binStr): int
    {
        if (is_int(bindec($binStr))) {
            return bindec($binStr);
        }
        // Convert back from two's compliment numbers (~abs($i)+1)
        $substr = substr($binStr, 1);
        return -(~bindec($substr) + 2 + PHP_INT_MAX);
    }
}
