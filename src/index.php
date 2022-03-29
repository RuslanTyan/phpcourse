<?php
declare(strict_types=1);

namespace PhpCourse;

require_once 'Tasks/Brackets.php';
require_once 'Tasks/FizzBuzz.php';
require_once 'Tasks/AddDigits.php';
require_once 'Tasks/Fibonacci.php';
require_once 'Tasks/PerfectNumber.php';

use AssertionError;
use InvalidArgumentException;
use PhpCourse\Tasks\AddDigits;
use PhpCourse\Tasks\Brackets;
use PhpCourse\Tasks\Fibonacci;
use PhpCourse\Tasks\FizzBuzz;
use PhpCourse\Tasks\PerfectNumber;
use Throwable;

function testAddDigits(array $arguments): void
{
    $theDigit = new AddDigits();
    foreach ($arguments as $key => $value) {
        try {
            $addDigitsValue = $theDigit->addDigits($key);
        } catch (InvalidArgumentException $exception) {
            echo $exception->getMessage(), PHP_EOL;
            continue;
        }
        if ($addDigitsValue === $value) {
            echo "addDigits({$key}) = {$value}", PHP_EOL;
            continue;
        }
        throw new AssertionError("Incorrect value of"
            . " addDigits({$key}) = {$addDigitsValue}, expected {$value}" . PHP_EOL);
    }
}

function testBrackets(array $arguments): void
{
    $br = new Brackets();
    foreach ($arguments as $key => $value) {
        try {
            $result = $br->isBalanced($key) ? 'true' : 'false';
        } catch (InvalidArgumentException $exception) {
            echo $exception->getMessage(), PHP_EOL;
            continue;
        }
        if ($result === $value) {
            echo "isBalanced({$key}) = {$value}", PHP_EOL;
            continue;
        }
        throw new AssertionError("Incorrect value of"
            . " isBalanced('{$key}') = {$result}, expected {$value}" . PHP_EOL);
    }
}

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

function testPerfectNumbers(array $arguments): void
{
    $pr = new PerfectNumber;
    foreach ($arguments as $key => $value) {
        $result = $pr->isPerfect($key) ? 'true' : 'false';
        if ($result === $value) {
            echo "isPerfect({$key}) = {$value}", PHP_EOL;
            continue;
        }
        throw new AssertionError("Incorrect value of"
            . " isPerfect('{$key}') = {$result}, expected {$value}" . PHP_EOL);
    }
}

// Tests addDigits
echo "Test AddDigits class", PHP_EOL;
$arguments = [
    -1 => -1,
    0 => 0,
    1 => 1,
    9 => 9,
    10 => 1,
    38 => 2,
    37 => 2, // incorrect value
];
try {
    testAddDigits($arguments);
} catch (Throwable $exception) {
    echo $exception->getMessage();
}

// FizzBuzz Tests
echo PHP_EOL, PHP_EOL, "Test FizzBuzz class", PHP_EOL;
$fbz = new FizzBuzz();
$fbz->fizzBuzz(11, 20);
echo PHP_EOL;
$fbz->fizzBuzz(-10, 20);
echo PHP_EOL;
$fbz->fizzBuzz(0, 0);
echo PHP_EOL;
$fbz->fizzBuzz(20, 1);

// Tests isBalanced
echo PHP_EOL, PHP_EOL, "Test Brackets class", PHP_EOL;
$arguments = [
    'a' => 'false',
    '' => 'true',
    '(())' => 'true',
    '((())' => 'false',
    ')(' => 'false',
    '())(' => 'false',
    '(()(())((()))(((()))))' => 'true',
    '(()(())((()))(((())))))' => 'true', // incorrect value
];
try {
    testBrackets($arguments);
} catch (Throwable $exception) {
    echo $exception->getMessage();
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

// Tests PerfectNumbers
echo PHP_EOL, PHP_EOL, "Test PerfectNumbers class", PHP_EOL;
$arguments = [
    -1 => 'false',
    0 => 'false',
    1 => 'false',
    3 => 'false',
    6 => 'true',
    27 => 'false',
    28 => 'true',
    496 => 'true',
    8128 => 'true',
    33550336 => 'true',
    33550337 => 'true' // incorrect value
];
try {
    testPerfectNumbers($arguments);
} catch (Throwable $exception) {
    echo $exception->getMessage();
}
