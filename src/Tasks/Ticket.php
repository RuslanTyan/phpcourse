<?php
declare(strict_types=1);

namespace PhpCourse\Tasks;

use InvalidArgumentException;

class Ticket
{
    public function isHappy(string $ticketNumber): bool
    {
        if (preg_match('/\D/', $ticketNumber) !== 0) {
            throw new InvalidArgumentException("Your ticket number: {$ticketNumber}"
                . " contains not only digits and not happy.\n");
        }
        $strLen = strlen($ticketNumber);
        if (($strLen % 2) !== 0) {
            return false;
        }
        for ($i = 0, $beginSum = 0, $endSum = 0; $i < $strLen / 2; $i++) {
            $beginSum += (int)$ticketNumber[$i];
            $endSum += (int)$ticketNumber[$strLen - 1 - $i];
        }
        return $beginSum === $endSum;
    }
}
