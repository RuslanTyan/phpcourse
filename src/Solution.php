<?php
declare(strict_types=1);

namespace PhpCourse\Solution;

function binarySum(string $num1, string $num2): string
{
    // Check only allowed symbols '0' or '1' are passed to variables
    if (!isBynaryString($num1) || !isBynaryString($num2)) {
        print_r("Error: Variables \$num1: '{$num1}' and \$num2: 
            '{$num2}' must contains only '0' and '1' symbols.\n");
        return 'Error: non binary arguments';
    }

    // Check arguments are less than can be safely converted to integer abs($arg) <= PHP_INT_MAX
    // TBD: Rewrite to ifs - see bad tests 1
    switch (false) {
        case isMaxSizeExceeded($num1):
            print_r("Error: Variable \$num1 is greater than max allowed by system\n");
        case isMaxSizeExceeded($num2):
            print_r("Error: Variable \$num2 is greater than max allowed by system\n");
            return 'Error: Arguments are too big';
    }

    // Convert to integers before summ
    $num1dec = strictBinDec($num1);
    $num2dec = strictBinDec($num2);

    // Summ the integers
    $resultDec = $num1dec + $num2dec;
    if (gettype($resultDec) === 'integer') {
        return decbin($resultDec);
    } else {
        print_r("Summ of the binaries is greater than maximum allowed integer in the system. 
            Summ:\n{$resultDec}\n");
        return "Error: Summ is too big number";
    }


}

function isBynaryString(string $str): bool
{
    return str_replace(['0', '1'], '', $str) === '';
}

function isMaxSizeExceeded(string $str): bool
{
    // Maximum integer in binary
    $systemBitsNum = strlen(decbin(PHP_INT_MAX)) + 1;
    if (strlen($str) > $systemBitsNum) {
        print_r("Argument {$str} has more bits than allowed by
            system to convert to integers: {$systemBitsNum}\n");
        return false;
    }
    return true;
}

function strictBinDec(string $binStr): int
{
    if (gettype(bindec($binStr)) === 'integer') {
        return bindec($binStr);
    } else {
        // Convert back from two's compliment numbers (~abs($i)+1)
        $substr = substr($binStr, 1);
        $res = -(~bindec($substr)+2 + PHP_INT_MAX);
        return $res;
    }
}

function myPrint(string $str): void
{
    echo 'Result:' . $str . "\n";
    echo 'Result-Dec: ' . (string)bindec($str) . "\n";
}

//Good tests:
//myPrint(binarySum('0','0')); // 0 + 0 = 0
//myPrint(binarySum(decbin(-1),decbin(0))); // -1 + 0 = -1 == | 1111111111111111111111111111111111111111111111111111111111111111
//myPrint(binarySum(decbin(-1),decbin(+1))); // -1 + 1 = 0
//myPrint(binarySum(decbin(-PHP_INT_MAX),decbin(+0))); // -PHP_INT_MAX + 0 = -PHP_INT_MAX == |1000000000000000000000000000000000000000000000000000000000000001
//myPrint(binarySum(decbin(PHP_INT_MAX),'0')); // PHP_INT_MAX + 0 = PHP_INT_MAX == |111111111111111111111111111111111111111111111111111111111111111
//myPrint(binarySum(decbin(PHP_INT_MAX),decbin(-PHP_INT_MAX))); // PHP_INT_MAX + -PHP_INT_MAX = 0
//myPrint(binarySum(decbin(PHP_INT_MAX),decbin(PHP_INT_MAX))); // Error - summ is too big
//myPrint(binarySum(decbin(-PHP_INT_MAX),decbin(PHP_INT_MAX) . '11')); // Error - argument is too big

// Bad tests (should be fixed):
myPrint(binarySum(decbin(-PHP_INT_MAX),decbin(PHP_INT_MAX) . '11')); // Error - argument is too big
myPrint(binarySum(decbin(-PHP_INT_MAX-33),decbin(PHP_INT_MAX))); // Error - argument is too big
