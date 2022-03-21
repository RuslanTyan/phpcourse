<?php
declare(strict_types=1);

namespace PhpCourse\Solution;

require_once 'OldSolution.php';

function binarySum(string $num1, string $num2): ?string
{
    if (!isBynaryString($num1) || !isBynaryString($num2)) {
        return null;
    }
    $strLen1 = strlen($num1);
    $strLen2 = strlen($num2);
    $strMax = ($strLen1 > $strLen2) ? $strLen1 : $strLen2;
    $result = '';
    for ($i = 0, $carry = 0; $i < $strMax; $i++) {
        // Proceed symbols from the end of string
        $symbol1 = getReverseSymbol($num1, $i);
        $symbol2 = getReverseSymbol($num2, $i);
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

function getReverseSymbol(string $str, int $posFromTail): string
{
    $strLen = strlen($str);
    return ($posFromTail < $strLen) ? $str[$strLen - 1 - $posFromTail] : '0';
}

function isBynaryString(string $str): bool
{
    return str_replace(['0', '1'], '', $str) === '';
}


function myPrint(string $str): void
{
    echo 'Result:' . $str . "\n";
    echo 'Result-Dec: ' . (string)bindec($str) . "\n";
}

//Good tests:
myPrint(binarySum('0','0'));                                                                           // 0
myPrint(binarySum('1111111111111111111111111111111111111111111111111111111111111111','0'));            // 1111111111111111111111111111111111111111111111111111111111111111
myPrint(binarySum(decbin('1111111111111111111111111111111111111111111111111111111111111111'),'1'));     // 10000000000000000000000000000000000000000000000000000000000000000
myPrint(binarySum(decbin(PHP_INT_MAX),'0'));                                                            // 111111111111111111111111111111111111111111111111111111111111111
myPrint(binarySum('11','11'));                                                                         // 110
myPrint(binarySum(decbin(PHP_INT_MAX),decbin(PHP_INT_MAX)));                                             // 1111111111111111111111111111111111111111111111111111111111111110
//myPrint(binarySum('PHP_INT_MAX',decbin(PHP_INT_MAX)));                                                  // null

if (\PhpCourse\OldSolution\binarySum('1111111', '1111111') === binarySum('1111111', '1111111')) {
    echo "Good, good!";
} // Good, good!
