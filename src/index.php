<?php
declare(strict_types=1);

namespace PhpCourse;

require_once 'Tasks/FizzBuzz.php';

use PhpCourse\Tasks\FizzBuzz;

// FizzBuzz Tests
$fbz = new FizzBuzz();
$fbz->fizzBuzz(11, 20);
echo PHP_EOL;
$fbz->fizzBuzz(-10, 20);
echo PHP_EOL;
$fbz->fizzBuzz(0, 0);
echo PHP_EOL;
$fbz->fizzBuzz(20, 1);
