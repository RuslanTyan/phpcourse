<?php

declare(strict_types=1);

namespace PhpCourseTests\Tasks;

use PhpCourse\Tasks\PowerOfThree;
use PHPUnit\Framework\TestCase;

class PowerOfThreeTest extends TestCase
{
    /**
     * @dataProvider isPowerOfThreeProvider
     */
    public function testIsPowerOfThree(int $num, bool $expected): void
    {
        $isPowerOf3 = (new PowerOfThree())->isPowerOfThree($num);
        self::assertTrue($expected === $isPowerOf3, "Actual: $isPowerOf3");
    }

    public function isPowerOfThreeProvider(): array
    {
        return [
            [-1, false],
            [0, false],
            [1, true],
            [2, false],
            [4, false],
            [9, true],
            [27, true],
            [81, true],
        ];
    }
}
