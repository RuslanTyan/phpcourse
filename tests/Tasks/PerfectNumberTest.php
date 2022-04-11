<?php

declare(strict_types=1);

namespace PhpCourseTests\Tasks;

use PhpCourse\Tasks\PerfectNumber;
use PHPUnit\Framework\TestCase;

class PerfectNumberTest extends TestCase
{
    /**
     * @dataProvider isPerfectProvider
     */
    public function testIsPerfect(int $num, $expected): void
    {
        $isPerfectNumber = (new PerfectNumber())->isPerfect($num);
        self::assertTrue($isPerfectNumber === $expected);
    }

    public function isPerfectProvider(): array
    {
        return [
            [-1, false],
            [0, false],
            [1, false],
            [3, false],
            [6, true],
            [27, false],
            [28, true],
            [496, true],
            [8128, true],
            [33550336, true],
            [33550337, false],
        ];
    }
}
