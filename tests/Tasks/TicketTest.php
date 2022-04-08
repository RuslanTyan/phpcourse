<?php

declare(strict_types=1);

namespace PhpCourseTests\Tasks;

use InvalidArgumentException;
use PhpCourse\Tasks\Ticket;
use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase
{
    /**
     * @dataProvider isHappyProvider
     */
    public function testIsHappy(string $number): void
    {
        $ticket = new Ticket();
        self::assertTrue($ticket->isHappy($number));
    }

    public function isHappyProvider(): array
    {
        return [
            ['385916'],
            ['054702'],
            ['00'],
            ['19283746'],
        ];
    }

    /**
     * @dataProvider isHappyInvalidInputProvider
     */
    public function testIsHappyInvalidInput(string $number): void
    {
        $ticket = new Ticket();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Your ticket number: {$number}"
            . " contains not only digits and not happy.\n");
        $ticket->isHappy($number);
    }

    public function isHappyInvalidInputProvider(): array
    {
        return [
            ['AB231002'],
            [''],
            [PHP_EOL . '11'],
        ];
    }

    /**
     * @dataProvider isHappyNegativeProvider
     */
    public function testIsHappyNegative(string $number): void
    {
        $ticket = new Ticket();
        self::assertFalse($ticket->isHappy($number));
    }

    public function isHappyNegativeProvider(): array
    {
        return [
            ['1'],
            ['111'],
            ['1222'],
            ['231002'],
        ];
    }
}
