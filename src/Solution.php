<?php
namespace PhpCourse\Solution;

function binarySum(string $num1, string $num2)
{
    // Check only allowed symbols '0' or '1' are passed to variables
    if (!isBynaryString($num1) or !isBynaryString($num2)) {
        print_r("Error: Variables \$num1: '{$num1}' and \$num2: '{$num2}' must contains only '0' and '1' symbols.\n");
        return false;
    }

    // Convert to integers before summ
    $num1dec = bindec($num1) <= PHP_INT_MAX ? bindec($num1) : -(PHP_INT_MAX - bindec(substr($num1, 1)) + 1);
    $num2dec = bindec($num2) <= PHP_INT_MAX ? bindec($num2) : -(PHP_INT_MAX - bindec(substr($num2, 1)) + 1);

    echo '$num1: ' . $num1 . "\n";
    echo '$num2: ' . $num2 . "\n";
    echo 'PHP_INT_MAX: ' . PHP_INT_MAX . "\n";
    echo '$num1dec: ' . $num1dec . "\n";
    echo '$num2dec: ' . $num2dec . "\n";

    // Summ the integers
    $resultDec = $num1dec + $num2dec;
    var_dump($resultDec);

    // Convert to binary
    return decbin($resultDec);


    //
}

function isBynaryString(string $str)
{
    return str_replace(['0', '1'], '', $str) === '';
}

echo binarySum('10', '1001') . "\n\n";
echo binarySum(decbin(-PHP_INT_MAX/10),decbin(-1)) . "\n\n";
echo binarySum(decbin(PHP_INT_MAX),decbin(-1)) . "\n\n";

// Doesn't work correctly
echo binarySum(decbin(-PHP_INT_MAX),decbin(+1)) . "\n\n";
