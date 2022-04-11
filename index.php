<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use PhpCourse\Tasks\AddDigits;
use PhpCourse\Tasks\BinarySum;
use PhpCourse\Tasks\BinarySumViaInt;
use PhpCourse\Tasks\Brackets;
use PhpCourse\Tasks\Fibonacci;
use PhpCourse\Tasks\FizzBuzz;
use PhpCourse\Tasks\PerfectNumber;
use PhpCourse\Tasks\PowerOfThree;
use PhpCourse\Tasks\Ticket;

function testFibonacci(array $arguments): void
{
    foreach ($arguments as $key => $value) {
        try {
            $result = Fibonacci::fib($key);
        } catch (InvalidArgumentException $exception) {
            echo $exception->getMessage(), PHP_EOL;
            continue;
        }
        if ($result === $value) {
            echo "fib({$key}) = {$value}", PHP_EOL;
            continue;
        }
        throw new AssertionError("Incorrect value of"
            . " fib({$key}) = {$result}, expected {$value}" . PHP_EOL);
    }
}

// Tests Fibonacci
echo PHP_EOL, PHP_EOL, "Test Fibonacci class", PHP_EOL;
$arguments = [
    -1 => -1,
    0 => 0,
    1 => 1,
    3 => 2,
    5 => 5,
    10 => 55,
    60 => 1548008755920,
    30 => 55, // incorrect value
];
try {
    testFibonacci($arguments);
} catch (Throwable $exception) {
    echo $exception->getMessage();
}

// Tests AddDigits
echo <<<HEREDOC
    
    AddDigits class:
    Method addDigits(int \$num1) returns sum of all digits within the given number if sum is less than 10
    or repeats the procedure recursively until its sum less than 10.
    
    HEREDOC;
$theSum = (new AddDigits())->addDigits(333);
echo <<<HEREDOC
    
    For example: (new AddDigits())->addDigits(333) equals:{$theSum}
    
    HEREDOC;

// Tests Ticket
echo <<<HEREDOC
    
    Ticket class:
    Method isHappy(string \$num1) returns true if the first part of number sum equal the last one
    
    HEREDOC;
$doEatTicket = (new Ticket())->isHappy('11');
echo <<<HEREDOC
    
    For example: (new Ticket())->isHappy('11') equals:{$doEatTicket}
    
    HEREDOC;

// Tests Brackets
echo <<<HEREDOC
    
    Brackets class:
    Method isBalanced(string \$str) returns true if the opening and closing brackets are balanced
    
    HEREDOC;
$brackets = (new Brackets())->isBalanced('()');
echo <<<HEREDOC
    
    For example: (new Brackets())->isBalanced('()') equals:{$brackets}
    
    HEREDOC;

// BinarySum
echo <<<HEREDOC
    
    BinarySum class:
    Method binarySum(string \$num1, string \$num2) returns the result of binary sum 
    of any binary numbers passed as strings. 
    
    HEREDOC;
$bsResult = (new BinarySum())->binarySum('000010', '10000');
echo <<<HEREDOC
    
    For example: (new BinarySum())->binarySum('000010', '10000') equals:{$bsResult}
    
    HEREDOC;

// BinarySumViaInt
echo <<<HEREDOC
    
    BinarySumViaInt class:
    Method binarySum(string \$num1, string \$num2) returns the result of binary sum 
    of any two's compliment numbers passed as strings. Can be used for manipulation with 
    singed numbers binary representations. Method arguments and result are limited by 
    (-PHP_INT_MAX, PHP_INT_MAX) range.
    
    HEREDOC;

$bsResult = (new BinarySumViaInt())->binarySum('1', decbin(-PHP_INT_MAX));
echo <<<HEREDOC
    
    For example: (new BinarySum())->binarySum('1', decbin(-PHP_INT_MAX)) equals:{$bsResult}
    
    HEREDOC;

// FizzBuzz
echo <<<HEREDOC
    
    FizzBuzz class:
    Method fizzBuzz(int \$begin, int \$end) returns the values of numbers between \$begin and \$end
    if it is not divided w/o remainder on 3 (in such case replaced by 'Fizz' string) or on 5 (in such
    case replaced by 'Buzz' string). Work for any integers \$begin <= \$end
    
    For example: (new FizzBuzz())->fizzBuzz(10, 20) prints:
    
    HEREDOC;
(new FizzBuzz())->fizzBuzz(10, 20);
echo PHP_EOL;

// PerfectNumber
echo <<<HEREDOC
    
    PerfectNumber class:
    Method isPerfect(int \$num) returns true given number is perfectt
    
    HEREDOC;
$isPerfect = (new PerfectNumber())->isPerfect(6) ? 'true' : 'false';
echo <<<HEREDOC
    
    For example: (new PerfectNumber())->isPerfect(6) equals:{$isPerfect}
    
    HEREDOC;

// PowerOfThree
echo <<<HEREDOC
    
    PowerOfThree class:
    Method isPowerOfThree(int \$num) returns true if the given number is power of 3
    
    HEREDOC;
$isPowerOf3 = (new PowerOfThree())->isPowerOfThree(6) ? 'true' : 'false';
echo <<<HEREDOC
    
    For example: (new PowerOfThree())->isPowerOfThree(6) equals:{$isPowerOf3}
    
    HEREDOC;
