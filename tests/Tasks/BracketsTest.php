<?php

declare(strict_types=1);

namespace PhpCourseTests\Tasks;

use InvalidArgumentException;
use PhpCourse\Tasks\Brackets;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertTrue;

class BracketsTest extends TestCase
{
    /**
     * @dataProvider isBalancedProvider
     */
    public function testIsBalanced(string $str, bool $expected): void
    {
        $brackets = new Brackets();
        assertTrue($brackets->isBalanced($str) === $expected);
    }

    public function isBalancedProvider(): array
    {
        return [
            ['', true],
            ['(())', true],
            ['((())', false],
            [')(', false],
            ['())(', false],
            ['(()(())((()))(((()))))', true],
        ];
    }

    /**
     * @dataProvider isBalancedInvalidInputProvider
     */
    public function testIsBalancedInvalidInput(string $str, string $invalidChar): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Error: String $str should contain only"
            . " '(' or ')' sybmols, but contains: $invalidChar");
        $brackets = new Brackets();
        $brackets->isBalanced($str);
    }

    public function isBalancedInvalidInputProvider(): array
    {
        return [
            ['a', 'a'],
            ['(")', '"'],
            ["\n", "\n"],
        ];
    }
}
