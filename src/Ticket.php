<?php
declare(strict_types=1);

namespace PhpCourse\Ticket;

function isHappy(string $ticketNumber): bool
{
    if (preg_match('/\D/', $ticketNumber) !== 0) {
        print_r("Your ticket number: {$ticketNumber} contains not only digits and not happy.\n");
        return false;
    }
    $strLen = strlen($ticketNumber);
    if (($strLen % 2) !== 0) {
        print_r("Your ticket number: {$ticketNumber} is not even and not happy.\n");
        return false;
    }
    for ($i = 0, $beginSum = 0, $endSum = 0; $i < $strLen / 2; $i++) {
        $beginSum += (int)$ticketNumber[$i];
        $endSum += (int)$ticketNumber[$strLen - 1 - $i];
    }
    if ($beginSum !== $endSum) {
        print_r("Your ticket number: {$ticketNumber} is not happy!\n");
        return false;
    }
    print_r("Your ticket number: {$ticketNumber} is happy!\n");
    return true;
}

isHappy('385916'); // true
isHappy('231002'); // false
isHappy('1222'); // false
isHappy('054702'); // true
isHappy('00'); // true
