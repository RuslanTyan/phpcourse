<?php
declare(strict_types=1);

namespace PhpCourse;

require_once 'Tasks/Brackets.php';
require_once 'Tasks/FizzBuzz.php';
require_once 'Tasks/AddDigits.php';

use AssertionError;
use InvalidArgumentException;
use PhpCourse\Tasks\AddDigits;
use PhpCourse\Tasks\Brackets;
use PhpCourse\Tasks\FizzBuzz;
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
        throw new AssertionError("Incorrect value of addDigits({$key}) = {$addDigitsValue}, expected {$value}" . PHP_EOL);
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
        throw new AssertionError("Incorrect value of isBalanced('{$key}') = {$result}, expected {$value}" . PHP_EOL);
    }
}

// Tests addDigits
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
$fbz = new FizzBuzz();
$fbz->fizzBuzz(11, 20);
echo PHP_EOL;
$fbz->fizzBuzz(-10, 20);
echo PHP_EOL;
$fbz->fizzBuzz(0, 0);
echo PHP_EOL;
$fbz->fizzBuzz(20, 1);

// Tests isBalanced
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
