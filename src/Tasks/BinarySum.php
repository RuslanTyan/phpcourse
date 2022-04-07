<?php
declare(strict_types=1);

namespace PhpCourse\Tasks;

use InvalidArgumentException;

class BinarySum
{
    public function binarySum(string $num1, string $num2): string
    {
        if (!$this->isBinaryString($num1) || !$this->isBinaryString($num2)) {
            throw new InvalidArgumentException("Error: Variables \$num1: '{$num1}' and \$num2:"
                . "'{$num2}' must contains only '0' and '1' symbols.\n");
        }
        $strLen1 = strlen($num1);
        $strLen2 = strlen($num2);
        $strMax = ($strLen1 > $strLen2) ? $strLen1 : $strLen2;
        $result = '';
        for ($i = 0, $carry = 0; $i < $strMax; $i++) {
            // Proceed symbols from the end of string
            $symbol1 = $this->getReverseSymbol($num1, $i);
            $symbol2 = $this->getReverseSymbol($num2, $i);
            switch ((int)$symbol1 + (int)$symbol2 + $carry) {
                case 0:
                    $symbol = '0';
                    break;
                case 1:
                    $symbol = '1';
                    $carry = 0;
                    break;
                case 2:
                    $symbol = '0';
                    $carry = 1;
                    break;
                case 3:
                    $symbol = '1';
                    $carry = 1;
                    break;
            }
            $result = $symbol . $result;
        }
        if ($carry === 1) {
            $result = '1' . $result;
        }
        return $result;
    }

    private function getReverseSymbol(string $str, int $posFromTail): string
    {
        $strLen = strlen($str);
        return ($posFromTail < $strLen) ? $str[$strLen - 1 - $posFromTail] : '0';
    }

    private function isBinaryString(string $str): bool
    {
        return str_replace(['0', '1'], '', $str) === '';
    }
}
