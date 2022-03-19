<?php
declare(strict_types=1);

namespace PhpCourse\Brackets;

function isBalanced (string $str): ?bool
{
    $strLength = strlen($str);
    $depth = 0;
    for ($i = 0; $i < $strLength; $i++) {
        switch ($str[$i]) {
            case '(':
                $depth++;
                break;
            case ')':
                $depth--;
                break;
            default:
                print_r("Error: String $str should contain only '(' or ')' sybmols.");
                return null;
        }
        // Immediately exit with false if closing bracket goes first or after balanced
        if ($depth < 0) return false;
    }
    return $depth === 0;
}

//Tests
var_dump(isBalanced('')); // true
var_dump(isBalanced('(())'));  // true
var_dump(isBalanced('((())')); // false
var_dump(isBalanced(')(')); //false
var_dump(isBalanced('())(')); //false
var_dump(isBalanced('(()(())((()))(((()))))')); //true
